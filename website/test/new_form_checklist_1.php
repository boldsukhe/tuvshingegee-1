<?php
require "db_connect.php";
$projectNames = $conn->query("SELECT name FROM projects");
$machine = $conn->query("SELECT name FROM machine");
$machines = [];
if ($machine && $machine->num_rows > 0) {
    while ($row = $machine->fetch_assoc()) {
        $machines[] = $row['name'];
    }
}

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
    <title>Гүйцэтгэл</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }

        form {
            width: 95%;
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .container {
            margin-left: 0;
            padding-left: 0;
            padding-top: 25px;
            display: flex;
            gap: 30px;
        }

        .label_input {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
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
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
        }

        table.styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            background: #fff;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .styled-table th,
        .styled-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
        }

        .styled-table th {
            background: #f9f9f9;
            font-weight: 600;
        }

        .machine_wrapper {
            display: flex;
            flex-direction: column;
            /* align-items: stretch; */
        }

        .machine_wrapper select.select2 {
            /* width: 100% !important; */
        }

        .machine_wrapper div {
            margin-top: 4px;
        }

        .tailbar {}

        .container_checklist {
            display: flex;
            align-items: center;
            /* vertically center if needed */
            gap: 5px;
            /* space between text and checkbox */

        }

        .container_checklist input {
            order: 1;
            /* ensures checkbox is after text */
        }

        label input[type="checkbox"] {
            transform: scale(1.8);
            /* enlarges checkbox */
            margin-left: 8px;
            /* spacing after text */
            vertical-align: middle;
            cursor: pointer;

        }
    </style>
</head>

<body>


    <?php include 'header.php'; ?>
    <form action="save_new_form_test_1.php" method="POST">
        <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">
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
            <select id="ajliin_turul" name="ajliin_turul"   >
                <option value=""></option>
            </select>
        </div>

        <div class="label_input">
            <label for="buleg">Бүлэг</label>
            <select id="buleg" name="buleg">
                <option value="">-- Ажлын төрөл эхлээд сонгоно уу. --</option>
            </select>
        </div>

        <div class="label_input">
            <label for="ded_buleg">Дэд бүлэг</label>
            <select id="ded_buleg" name="ded_buleg">
                <option value="">-- Бүхэл эхлээд сонгоно уу. --</option>
            </select>
        </div>


        <div id="container_checklist">

        </div>

        <div class="container">
            <div class="label_input">
                <label for="niit_hiisen_input">Нийт хийгдсэн</label>
                <input type="text" name="niit_hiisen" id="niit_hiisen_input" readonly>
            </div>

            <div class="label_input">
                <label for="ognoo">Огноо</label>
                <input type="date" id="ognoo" name="ognoo">
            </div>
            <div class="label_input" style="flex: 1;">
                <label for="tailbar">Тайлбар</label>
                <input type="text" id="tailbar" name="tailbar" style="width:100%;">
            </div>
        </div>

        <!-- Example Table -->
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Эхлэл ПК</th>
                    <th>Төгсгөл ПК</th>
                    <th>Нийт ажил</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="col1" class="table-input"></td>
                    <td><input type="text" name="col2" class="table-input"></td>
                    <td><input type="text" name="col3" class="table-input"></td>
                </tr>
            </tbody>
        </table>

        <!-- Machine Table -->
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
                    <td>Ажилласан ажилтан</td>
                    <td><input type="text" name="uuriin_worker" class="table-input"></td>
                    <td><input type="text" name="tuslan_worker" class="table-input"></td>
                    <td><input type="text" name="turees_worker" class="table-input"></td>
                </tr>
                <tr>
                    <td>Ажилласан цаг</td>
                    <td><input type="text" name="uuriin_work_hours" class="table-input"></td>
                    <td><input type="text" name="tuslan_work_hours" class="table-input"></td>
                    <td><input type="text" name="turees_work_hours" class="table-input"></td>
                </tr>
                <tr>
                    <td>Машин механизм</td>
                    <td>
                        <div class="machine_wrapper">
                            <select id="uuriin_machine" name="uuriin_machine[]" multiple class="select2">
                                <?php foreach ($machines as $name): ?>
                                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="uuriin_machine_tsag"></div>
                        </div>
                    </td>
                    <td>
                        <div class="machine_wrapper">
                            <select id="tuslan_machine" name="tuslan_machine[]" multiple class="select2">
                                <?php foreach ($machines as $name): ?>
                                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="tuslan_machine_tsag"></div>
                        </div>
                    </td>
                    <td>
                        <div class="machine_wrapper">
                            <select id="turees_machine" name="turees_machine[]" multiple class="select2">
                                <?php foreach ($machines as $name): ?>
                                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="turees_machine_tsag"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="label_input">
            <button type="submit">Хадгалах</button>
        </div>
    </form>

    <script type="module">
        import { resetSelect } from '/utility.js';
        
        
    </script>
    <script>
        

        $('#project').on('change', function () {
            var projectName = this.value;
            const buleg = document.getElementById("buleg");
            const ded_buleg = document.getElementById("ded_buleg");
            const container = document.getElementById("container_checklist");
            container.innerHTML = ""; // clear previous checklist
            if (projectName !== "") {
                fetch("get_ajliin_turul.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "project_name=" + encodeURIComponent(projectName)
                })
                    .then(response => response.json())
                    .then(data => {
                        const select = document.getElementById("ajliin_turul");
                        select.innerHTML = "";
                        if (data.length > 0) {
                            data.forEach(item => {
                        

                                

                                let option = document.createElement("option");
                                option.value = item;      // internal value
                                option.textContent = item; // visible label
                                select.appendChild(option);
                                
                                const select_ded_buleg = document.getElementById("ded_buleg");
                               
                                resetSelect(select_ded_buleg, "Дэд бүлэг сонгоно уу.");
                                
                                





                            });

                        } else {
                        
                            buleg.innerHTML = '<option value="">Ажлын төрөл олдсонгүй</option>';
                            ded_buleg.innerHTML = '<option value="">Ажлын төрөл олдсонгүй</option>';
                            let option = document.createElement("option");
                            option.text = "Ажлын төрөл олдсонгүй";
                            option.value = "";
                            select.appendChild(option);
                        }
                        $('#ajliin_turul').trigger('change');
                        //document.getElementById("buleg_utga").textContent = "";
                        //document.getElementById("ded_buleg").innerHTML = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';
                    });
            }
        });
        $('#buleg').on('change', function () {
            var buleg = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601
            var ajliin_turul = document.getElementById('ajliin_turul').value;
            var projectName = document.getElementById('project').value;
            const container = document.getElementById("container_checklist");
            container.innerHTML = ""; // clear previous checklist
            if (ajliin_turul !== "") {
                fetch("get_ajliin_ded_buleg.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "ajliin_turul=" + encodeURIComponent(ajliin_turul) +
                        "&projectName=" + encodeURIComponent(projectName) +
                        "&buleg=" + encodeURIComponent(buleg)

                })
                    .then(response => response.json())
                    .then(data => {

                        const select = document.getElementById("ded_buleg");
                    

                        if (data.length > 0) {
                            data.forEach(item => {
                                let option = document.createElement("option");
                                option.value = item.group_number;
                                option.text = `${item.group_number} -  Нийт ажил (${item.quantity}) - Нэгж (${item.negj})`;
                                select.appendChild(option);
                            });
                        } else {
                            let option = document.createElement("option");
                            option.text = "No data found";
                            select.appendChild(option);
                        }
                    })
                    .catch(error => console.error("Fetch error:", error));
            } else {
                console.log("No value selected");
            }
        });

        //////////////////////////////ajliin_dugaar
        $('#ajliin_turul').on('change', function () {

            var ajliin_turul = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601
            var projectName = document.getElementById('project').value;
            const container = document.getElementById("container_checklist");
            const ded_buleg = document.getElementById("ded_buleg");
            container.innerHTML = ""; // clear previous checklist
            if (ajliin_turul !== "") {
                fetch("get_buleg.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "ajliin_turul=" + encodeURIComponent(ajliin_turul) +
                        "&projectName=" + encodeURIComponent(projectName)

                })
                    .then(response => response.json())
                    .then(data => {

                        console.log("AJLIIN TURUL END YAVJIIN");
                        resetSelect(ded_buleg,"Бүлэг сонгоно уу.");
                        if (data.length > 0) {
                            data.forEach(item => {
                                let option = document.createElement("option");
                                option.value = item.group_number;
                                option.text = `${item.group_number} -  Нийт ажил (${item.quantity}) - Нэгж (${item.negj})`;
                                select.appendChild(option);
                            });
                        } else {
                            let option = document.createElement("option");
                            option.text = "No data found";
                            select.appendChild(option);
                        }
                    })
                    .catch(error => console.error("Fetch error:", error));
            } else {
                console.log("No value selected");
            }
        });
        //////////////////////niit_ajil
        $('#ded_buleg').on('change', function () {

            var ded_buleg = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601

            var projectName = document.getElementById('project').value;
            var ajliin_turul = document.getElementById('ajliin_turul').value;

            if (ded_buleg !== "") {
                fetch("get_niit_hiisen.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "ajliin_turul=" + encodeURIComponent(ajliin_turul) +
                        "&projectName=" + encodeURIComponent(projectName) +
                        "&ded_buleg=" + encodeURIComponent(ded_buleg)
                })
                    .then(response => response.json())
                    .then(data => {

                        const niit_hiisen_input = document.getElementById("niit_hiisen_input");
                        //#cccconst niit_hiisen_text = document.getElementById("niit_hiisen_text");
                        if (data && data.niit_ajil !== undefined) {
                            niit_hiisen_input.value = data.niit_ajil;
                            // niit_hiisen_text.text = data.niit_ajil;

                        } else {
                            niit_hiisen_input.value = "";
                            // niit_hiisen_text.textContent = "No data";

                            console.warn("⚠️ No niit_ajil found in response");
                        }
                    })
                    .catch(error => console.error("❌ Fetch error:", error));
            } else {
                console.log("⚠️ No ded_buleg selected");
            }
        });

        $('#ded_buleg').on('change', function () {

            var ded_buleg = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601
            console.log("checklist ded buleg:", ded_buleg);
            if (ded_buleg !== "") {
                fetch("get_ded_buleg.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body:
                        "&ded_buleg=" + encodeURIComponent(ded_buleg)
                })
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById("container_checklist");
                        container.innerHTML = ""; // clear previous list

                        if (data.length > 0) {
                            data.forEach((item, index) => {
                                const wrapper = document.createElement("div");

                                // 👇 Hidden input ensures 0 is sent if checkbox is NOT checked
                                const hidden = document.createElement("input");
                                hidden.type = "hidden";
                                hidden.name = `checkbox_values[${item}]`;
                                hidden.value = "0";

                                // 👇 Checkbox (same name)
                                const checkbox = document.createElement("input");
                                checkbox.type = "checkbox";
                                checkbox.id = `myCheckbox_${index}`;
                                checkbox.name = `checkbox_values[${item}]`;
                                checkbox.value = "1";

                                // Label
                                const label = document.createElement("label");
                                label.htmlFor = checkbox.id;
                                label.textContent = item + " ";

                                // ✅ Append all to wrapper

                                label.appendChild(checkbox); // checkbox after text

                                wrapper.appendChild(hidden);
                                wrapper.appendChild(label);

                                container.appendChild(wrapper);

                            });
                        } else {
                            container.textContent = "No data available.";
                        }
                    })
                    .catch(error => console.error("❌ Fetch error:", error));
            } else {
                console.log("⚠️ No ded_buleg selected");
            }
        });


        $(document).ready(function () {
            $('#uuriin_machine').select2();
            $('#tuslan_machine').select2();
            $('#turees_machine').select2();

            function setupMachineChange(selectId, containerId, inputName) {
                $(selectId).on('change', function () {
                    const selected = $(this).val();
                    const container = $(containerId);
                    container.empty();
                    if (selected) {
                        selected.forEach(machine => {
                            container.append(`
                        <div style="margin-bottom:8px;">
                            <label>${machine}</label>
                            <input type="number" name="${inputName}[${machine}]" placeholder="Машин цаг">
                        </div>
                    `);
                        });
                    }
                });
            }

            setupMachineChange('#uuriin_machine', '#uuriin_machine_tsag', 'uuriin_machine_tsag');
            setupMachineChange('#tuslan_machine', '#tuslan_machine_tsag', 'tuslan_machine_tsag');
            setupMachineChange('#turees_machine', '#turees_machine_tsag', 'turees_machine_tsag');
        });
    </script>
</body>

</html>