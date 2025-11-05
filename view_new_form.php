<?php
require "db_connect.php";
$projectNames = $conn->query("SELECT name FROM projects");




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Project</title>
    <style>
        /* Your provided CSS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            font-size: 13px;
            margin: 0;
            padding: 0;
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
        form {
            width: 95%;
            max-width: 1000px;
            margin: 30px auto;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 5px;
        }
        .box_header {
            padding: 15px 10px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            text-align: left;
        }
        .box_header h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px 30px;
            margin-top: 20px;
        }
        .label_input {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            padding: 8px 10px;
            font-size: 13px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }
        .full-width {
            grid-column: 1 / -1;
        }
        .button {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 13px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
        .buleg_utga {
            padding: 8px 10px; /* Match input/select */
            font-size: 13px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 4px;
            height: 36px;
            line-height: 18px;
            box-sizing: border-box;
            /* margin-top: 8px; */
            display: flex;
            align-items: center; /* Center text vertically */
            margin: 0;
            /* margin-top: 8px; */
        }
        .ded_buleg_utga{
            padding: 8px 10px; /* Match input/select */
        font-size: 13px;
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 4px;
        height: 36px;
        line-height: 18px;
        box-sizing: border-box;
        /* margin-top: 8px; */
        display: flex;
        align-items: center; /* Center text vertically */
        margin: 0;
        /* margin-top: 8px; */
        }
        .niit_ajil {
            padding: 8px 10px; /* Match input/select */
        font-size: 13px;
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 4px;
        height: 36px;
        line-height: 18px;
        box-sizing: border-box;
        /* margin-top: 8px; */
        display: flex;
        align-items: center; /* Center text vertically */
        margin: 0;
        }
    /*table style */
        .table-container {
        margin-top: 30px;
        overflow-x: auto;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 5px;
            overflow: hidden;
        }

        .styled-table th,
        .styled-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            color: #333;
        }

        .styled-table th {
            background-color: #f9f9f9;
            font-weight: 600;
        }

    </style>
</head>
<body>
<nav>
    <a href="view_project.php">Төсөл</a>
    <a href="view_new_form.php">Гүйцэтгэл</a>
    <a href="new_form.php">Маягт</a>
    <a href="login.php">Гарах</a>
</nav>

<form action="submit_new_form.php" method="POST">
    <div class="box_header">
        <h3>Маягт</h3>
    </div>

    <div class="form-grid">

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
            <label for="project-id">Бүлэг дугаар</label>
            <select id="project_group_number">
                <option value="">-- Төсөл эхлээд сонгоно уу --</option>
            </select>
        </div>

        <div class="label_input">
            <label for="buleg_utga">Бүлгийн утга</label>
            <p id="buleg_utga" class = "buleg_utga"> </p>
        </div>

        <div class="label_input">
            <label for="ded_buleg">Дэд бүлэг</label>
            <select id="ded_buleg">
                <option value="">-- Бүлэг эхлээд сонгоно уу. --</option>
            </select>
        </div>

        <div class="label_input">
            <label for="ded_buleg_utga">Дэд Бүлгийн утга</label>
            <p id="ded_buleg_utga" class = "ded_buleg_utga"> </p>
        </div>

        <div class="label_input">
            <label for="niit_ajil">Нийт ажил</label>
            <p id="niit_ajil" class = "niit_ajil"> </p>
        </div>

       

    </div>


    <div class="table-container">
    

    <div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th></th>
                <th>Өөрийн</th>
                <th>Туслангийн</th>
                <th>Түрээс</th>
            </tr>
        </thead>
        <tbody>
    <tr>
        <td>Нийт ажилласан ажилтан</td>
        <td><input type="text" id="uuriin_worker" name="uuriin_worker" class="table-input" readonly></td>
        <td><input type="text" id="tuslan_worker" name="tuslan_worker" class="table-input" readonly></td>
        <td><input type="text" id="turees_worker" name="turees_worker" class="table-input" readonly></td>
    </tr>
    <tr>
        <td>Нийт ажилласан цаг</td>
        <td><input type="text" id = "uuriin_work_hours" name="uuriin_work_hours" class="table-input" readonly></td>
        <td><input type="text" id = "tuslan_work_hours" name="tuslan_work_hours" class="table-input" readonly></td>
        <td><input type="text" id = "turees_work_hours" name="turees_work_hours" class="table-input" readonly></td>
    </tr>
    <tr>
        <td>Нийт машин механизм</td>
        <td><input type="text" id = "uuriin_machine" name="uuriin_machine" class="table-input" readonly></td>
        <td><input type="text" id = "tuslan_machine" name="tuslan_machine" class="table-input" readonly></td>
        <td><input type="text" id = "turees_machine" name="turees_machine" class="table-input" readonly></td>
    </tr>
    <tr>
        <td>Нийт машин механизм цаг</td>
        <td><input type="text" id = "uuriin_machine_hours" name="uuriin_machine_hours" class="table-input" readonly></td>
        <td><input type="text" id = "tuslan_machine_hours" name="tuslan_machine_hours" class="table-input" readonly></td>
        <td><input type="text" id = "turees_machine_hours" name="turees_machine_hours" class="table-input" readonly></td>
    </tr>
</tbody>

    </table>
</div>

</div>


</form>

<script>
    document.getElementById("project").addEventListener("change", function () {
        var projectName = this.value;

        if (projectName !== "") {
            fetch("get_project_id.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "project_name=" + encodeURIComponent(projectName)
            })
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("project_group_number");
                select.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(id => {
                        let option = document.createElement("option");
                        option.value = id;
                        option.text = id;
                        select.appendChild(option);
                    });
                } else {
                    let option = document.createElement("option");
                    option.text = "No ID found";
                    option.value = "";
                    select.appendChild(option);
                }

                document.getElementById("buleg_utga").textContent = "";
                document.getElementById("ded_buleg").innerHTML = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';
            });
        }
    });

    document.getElementById("project_group_number").addEventListener("change", function () {
        var ded_buleg = this.value; // ded_buleg iig buleg bolgoh

        if (ded_buleg !== "") {
            fetch("get_ded_buleg.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "ded_buleg=" + encodeURIComponent(ded_buleg)
            })
            .then(response => response.json())
            .then(data => {
                const ded_buleg_utga = document.getElementById("buleg_utga");
                ded_buleg_utga.textContent = data.utga || "No description";

                const select = document.getElementById("ded_buleg");
                select.innerHTML = "";

                const sliced = Object.keys(data)
                                    .filter(key => !isNaN(key))
                                    .sort((a, b) => a - b)
                                    .map(key => data[key]);

                if (sliced.length > 0) {
                    sliced.forEach(id => {
                        let option = document.createElement("option");
                        option.value = id;
                        option.text = id;
                        select.appendChild(option);
                    });
                } else {
                    let option = document.createElement("option");
                    option.text = "No ID found";
                    option.value = "";
                    select.appendChild(option);
                }
            });
        }
    });
    document.getElementById("ded_buleg").addEventListener("change", function () {
        var ded_buleg = this.value;

        if (ded_buleg !== "") {
            fetch("get_ded_buleg_utga.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "get_ded_buleg_utga=" + encodeURIComponent(ded_buleg)
            })
            .then(response => response.json())
            .then(data => {
                const ded_buleg_utga = document.getElementById("ded_buleg_utga");
                ded_buleg_utga.textContent = data.utga || "No description";
                fetchWorkerTotals();

                // const select = document.getElementById("ajilbar");
                // select.innerHTML = "";

                // const sliced = Object.keys(data)
                //                     .filter(key => !isNaN(key))
                //                     .sort((a, b) => a - b)
                //                     .map(key => data[key]);

                // if (sliced.length > 0) {
                //     sliced.forEach(id => {
                //         let option = document.createElement("option");
                //         option.value = id;
                //         option.text = id;
                //         select.appendChild(option);
                //     });
                // } else {
                //     let option = document.createElement("option");
                //     option.text = "No ID found";
                //     option.value = "";
                //     select.appendChild(option);
                // }
            });
        }
    });
     function fetchWorkerTotals() {
            const project = document.getElementById("project").value;
            const group_number = document.getElementById("project_group_number").value;
            const ded_buleg = document.getElementById("ded_buleg").value;

            if (project && group_number && ded_buleg) {
                fetch("get_sums.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `project=${encodeURIComponent(project)}&group_number=${encodeURIComponent(group_number)}&ded_buleg=${encodeURIComponent(ded_buleg)}`
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.uuriin_worker);
                    document.querySelector('input[name="uuriin_worker"]').value = data.uuriin_worker || 0;
                    document.querySelector('input[name="tuslan_worker"]').value = data.tuslan_worker || 0;
                    document.querySelector('input[name="turees_worker"]').value = data.turees_worker || 0;
                    document.querySelector('input[name="uuriin_work_hours"]').value = data.uuriin_work_hours || 0;
                    document.querySelector('input[name="tuslan_work_hours"]').value = data.tuslan_work_hours || 0;
                    document.querySelector('input[name="turees_work_hours"]').value = data.turees_work_hours || 0;
                    document.querySelector('input[name="uuriin_machine"]').value = data.uuriin_machine || 0;
                    document.querySelector('input[name="tuslan_machine"]').value = data.tuslan_machine || 0;
                    document.querySelector('input[name="turees_machine"]').value = data.turees_machine || 0;
                    document.querySelector('input[name="uuriin_machine_hours"]').value = data.uuriin_machine_hours || 0;
                    document.querySelector('input[name="tuslan_machine_hours"]').value = data.tuslan_machine_hours || 0;
                    document.querySelector('input[name="turees_machine_hours"]').value = data.turees_machine_hours || 0;
                    const niit_ajil = document.getElementById("niit_ajil");
                    niit_ajil.textContent = data.niit_ajil;
                });
            }
        }
</script>

</body>
</html>
