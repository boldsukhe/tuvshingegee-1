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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            font-weight: 400;
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

        .buleg_utga_display {
            font-weight: 600;
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

        .hereglegch_ner {
            margin: 0;
            padding: 0;
        }

        .ajliin_turul {
            margin: 0;
            padding: 0;
        }
       
       .select2-container--default .select2-selection--multiple {
            padding: 4px 8px;
            font-size: 13px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 4px;
            min-height: 36px;
            box-sizing: border-box;
        }

        .select2-container {
            width: 100% !important;
        }
        .select2-container--default .select2-selection--multiple {
            height: 36px;
            display: flex;
            align-items: center;
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

<form action="save_new_form_test_1.php" method="POST">
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

        <!-- <div class="label_input">
            <label for="project-id">Бүлэг дугаар</label>
            <select id="project_group_number" name="project_group_number">
                <option value="">-- Төсөл эхлээд сонгоно уу --</option>
            </select>
        </div> -->
        <div class="label_input">
            <label for="project_group_number">Бүлэг дугаар</label>
            <select id="project_group_number" name="project_group_number" style="width: 100%;">
                <option value="">гэр барих - 250601</option>
                <option value="">гэр буулгах - 111111</option>
           
            </select>
        </div>

        <div class="label_input">
            <label for="buleg_utga">Бүлгийн утга</label>
            <p id="buleg_utga_display" class="buleg_utga"></p>
            <input type="hidden" name="buleg_utga" id="buleg_utga">
        </div>

        <div class="label_input">
            <label for="ded_buleg">Дэд бүлэг</label>
            <select id="ded_buleg" name="ded_buleg">
                <option value="">-- Бүлэг эхлээд сонгоно уу. --</option>
            </select>
        </div>

        <div class="label_input">
            <label for="ded_buleg_utga">Дэд Бүлгийн утга</label>
            <p id="ded_buleg_utga_display" class="ded_buleg_utga"></p>
            <input type="hidden" name="ded_buleg_utga" id="ded_buleg_utga">
        </div>

        <div class="label_input">
            <label for="ajilbar">Ажилбар</label>
            <select id="ajilbar" name="ajilbar">
                <option value="">-- Дэд бүлэг эхлээд сонгоно уу. --</option>
            </select>
        </div>

        <div class="label_input">
            <label for="hereglegch_ner">Хэрэглэгчийн нэр</label>
            <p id="hereglegch_ner" class="hereglegch_ner"></p>
            <input type="text" name="hereglegch_ner" id="hereglegch_ner">
        </div>

        <div class="label_input">
            <label for="ajliin_turul">Ажлын төрөл</label>
            <p id="ajliin_turul" class="ajliin_turul"></p>
            <input type="text" name="ajliin_turul" id="ajliin_turul">
        </div>

        <div class="label_input">
            <label for="Огноо">Огноо</label>
            <input type="date" id="ognoo" name="ognoo">
        </div>

    </div>

    <div class="table-container">
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
            <select id="languages" name="languages[]" multiple class="select2" style="width: 100%;" > 
                <?php foreach ($machines as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
             <select id="languages_2" name="languages[]" multiple class="select2">
                <?php foreach ($machines as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td>
           <select id="languages_3" name="languages[]" multiple class="select2">
                <?php foreach ($machines as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Машин механизм цаг</td>
        <td><input type="text" name="uuriin_machine_hours" class="table-input"></td>
        <td><input type="text" name="tuslan_machine_hours" class="table-input"></td>
        <td><input type="text" name="turees_machine_hours" class="table-input"></td>
    </tr>
</tbody>

    </table>
</div>

</div>

<div class="button">
        <button type="submit">Хадгалах</button>
    </div>
</form>

<script>
    document.getElementById("project").addEventListener("change", function () {
        var projectName = this.value;
        console.log("project");
        if (projectName !== "") {
            fetch("get_project_name.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "project_name=" + encodeURIComponent(projectName)
            })
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById("project_group_number");
                // select.innerHTML = "";
                 if (data.length > 0) {
                        data.forEach(item => {
                            let option = document.createElement("option");
                            option.value = item.id;      // internal value
                            option.textContent = item.text; // visible label
                            select.appendChild(option);
                        });
                // if (data.length > 0) {
                //     data.forEach(id => {
                //         let option = document.createElement("option");
                //         option.value = id;
                //         option.text = id;
                //         select.appendChild(option);
                //     });
                } else {
                    let option = document.createElement("option");
                    option.text = "No ID found";
                    option.value = "";
                    select.appendChild(option);
                }
                $('#project_group_number').val('').trigger('change');
                document.getElementById("buleg_utga").textContent = "";
                document.getElementById("ded_buleg").innerHTML = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';
            });
        }
    });
    $('#project_group_number').on('change', function () {
        console.log("hello project_group_number");
        var ded_buleg = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601
        console.log("hello project_group_number");
        if (ded_buleg !== "") {
            fetch("get_ded_buleg_number.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "ded_buleg=" + encodeURIComponent(ded_buleg)
            })
            .then(response => response.json())
            .then(data => {
                const buleg_utga = document.getElementById("buleg_utga");
                const buleg_utga_display = document.getElementById("buleg_utga_display");
                
                console.log(data.buleg_id);
                buleg_utga.value = data.buleg_id || "No description";
                buleg_utga_display.textContent = data.buleg_id || "No description";
                
                ////////////////////////////////////////////////////////////////////
                    const select = document.getElementById("ded_buleg");
                    select.innerHTML = "";

                    data.forEach(item => {
                        let option = document.createElement("option");
                        option.value = item.id;
                        option.text = item.text;
                        select.appendChild(option);
                    });

                // const select = document.getElementById("ded_buleg");
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
                // } 
                
            });
        } 
        else {
                    let option = document.createElement("option");
                    option.text = "No ID found";
                    option.value = "";
                }
    });
    $(document).ready(function () {
    $('#project_group_number').select2({
        placeholder: "-- Бүлэг дугаар сонгоно уу --",
        allowClear: true
    });
});
//     $(document).ready(function () {
//     $('#project_group_number').on('change', function () {
//         console.log("Triggered: project_group_number changed");

//         var ded_buleg = this.value;

//         if (ded_buleg !== "") {
//             fetch("get_ded_buleg_number.php", {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/x-www-form-urlencoded"
//                 },
//                 body: "ded_buleg=" + encodeURIComponent(ded_buleg)
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error("HTTP error " + response.status);
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 console.log("Received data:", data);

//                 const buleg_utga = document.getElementById("buleg_utga");
//                 const buleg_utga_display = document.getElementById("buleg_utga_display");
//                 const select = document.getElementById("ded_buleg");

//                 buleg_utga.value = data.buleg_id || "No description";
//                 buleg_utga_display.textContent = data.buleg_id || "No description";

//                 // Clear old options
//                 select.innerHTML = "";

//                 // Filter numeric keys (0,1,2..) only
//                 const sliced = Object.keys(data)
//                     .filter(key => !isNaN(key))
//                     .sort((a, b) => a - b)
//                     .map(key => data[key]);

//                 if (sliced.length > 0) {
//                     sliced.forEach(id => {
//                         let option = document.createElement("option");
//                         option.value = id;
//                         option.text = id;
//                         select.appendChild(option);
//                     });
//                 } else {
//                     let option = document.createElement("option");
//                     option.text = "No ID found";
//                     option.value = "";
//                     select.appendChild(option);
//                 }
//             })
//             .catch(error => {
//                 console.error("Fetch error:", error);
//                 alert("Error loading ded_buleg data.");
//             });
//         }
//     });
// });

//     $(document).ready(function () {
//     $('#project_group_number').on('change', function () {
//         console.log("hello project_group_number");

//         var ded_buleg = $(this).val(); // safer with jQuery if Select2 used

//         if (ded_buleg !== "") {
//             fetch("get_ded_buleg_number.php", {
//                 method: "POST",
//                 headers: { "Content-Type": "application/x-www-form-urlencoded" },
//                 body: "ded_buleg=" + encodeURIComponent(ded_buleg)
//             })
//             .then(response => response.json())
//             .then(data => {
//                 const buleg_utga = document.getElementById("buleg_utga");
//                 const buleg_utga_display = document.getElementById("buleg_utga_display");

//                 buleg_utga.value = data.buleg_id || "No description";
//                 buleg_utga_display.textContent = data.buleg_id || "No description";

//                 const select = document.getElementById("ded_buleg");
//                 select.innerHTML = "";

//                 const sliced = Object.keys(data)
//                     .filter(key => !isNaN(key))
//                     .sort((a, b) => a - b)
//                     .map(key => data[key]);

//                 if (sliced.length > 0) {
//                     sliced.forEach(id => {
//                         let option = document.createElement("option");
//                         option.value = id;
//                         option.text = id;
//                         select.appendChild(option);
//                     });
//                 } else {
//                     let option = document.createElement("option");
//                     option.text = "No ID found";
//                     option.value = "";
//                     select.appendChild(option);
//                 }
//             });
//         }
//     });
// });
    console.log("Attaching project_group_number change event");
    // document.getElementById("project_group_number").addEventListener("change", function () {
    //     console.log("hello project_group_number");
    //     var ded_buleg = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601
    //     console.log("hello project_group_number");
    //     if (ded_buleg !== "") {
    //         fetch("get_ded_buleg_number.php", {
    //             method: "POST",
    //             headers: { "Content-Type": "application/x-www-form-urlencoded" },
    //             body: "ded_buleg=" + encodeURIComponent(ded_buleg)
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             const buleg_utga = document.getElementById("buleg_utga");
    //             const buleg_utga_display = document.getElementById("buleg_utga_display");
                
    //             console.log(data.buleg_id);
    //             buleg_utga.value = data.buleg_id || "No description";
    //             buleg_utga_display.textContent = data.buleg_id || "No description";


    //             const select = document.getElementById("ded_buleg");
    //             select.innerHTML = "";

    //             const sliced = Object.keys(data)
    //                                 .filter(key => !isNaN(key))
    //                                 .sort((a, b) => a - b)
    //                                 .map(key => data[key]);

    //             if (sliced.length > 0) {
    //                 sliced.forEach(id => {
    //                     let option = document.createElement("option");
    //                     option.value = id;
    //                     option.text = id;
    //                     select.appendChild(option);
    //                 });
    //             } else {
    //                 let option = document.createElement("option");
    //                 option.text = "No ID found";
    //                 option.value = "";
    //                 select.appendChild(option);
    //             }
    //         });
    //     }
    // });
    
    // document.getElementById("ded_buleg").addEventListener("change", function () {
    //     var ded_buleg = this.value;

    //     if (ded_buleg !== "") {
    //         fetch("get_ded_buleg_utga.php", {
    //             method: "POST",
    //             headers: { "Content-Type": "application/x-www-form-urlencoded" },
    //             body: "get_ded_buleg_utga=" + encodeURIComponent(ded_buleg)
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             const ded_buleg_utga = document.getElementById("ded_buleg_utga_display");
    //             ded_buleg_utga_display.textContent = data.utga || "No description";
    //             ded_buleg_utga.value = data.utga;
    //             const select = document.getElementById("ajilbar");
    //             select.innerHTML = "";

    //             const sliced = Object.keys(data)
    //                                 .filter(key => !isNaN(key))
    //                                 .sort((a, b) => a - b)
    //                                 .map(key => data[key]);

    //             if (sliced.length > 0) {
    //                 sliced.forEach(id => {
    //                     let option = document.createElement("option");
    //                     option.value = id;
    //                     option.text = id;
    //                     select.appendChild(option);
    //                 });
    //             } else {
    //                 let option = document.createElement("option");
    //                 option.text = "No ID found";
    //                 option.value = "";
    //                 select.appendChild(option);
    //             }
    //         });
    //     }
    // });
     $(document).ready(function () 
     {
        $('#languages').select2({ placeholder: "Select machines", width : '100%' });
        $('#languages_2').select2({ placeholder: "Select more machines" });
        $('#languages_3').select2({ placeholder: "Select more machines" });
     });

    //  $(document).ready(function () {
    //     $('#project_group_number').select2({
    //         placeholder: "-- Төсөл эхлээд сонгоно уу --",
    //         allowClear: true
    //     });
    // });
</script>

</body>
</html>
