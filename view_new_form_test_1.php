<?php
require "db_connect.php";
$projectNames = $conn->query("SELECT name FROM projects");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Select Project</title>
    <style>
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
        .form-wrapper {
            width: 95%;
            
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
        grid-column: 1 / -1; /* Add this line */
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

        .table-box {
                padding: 8px;
                background-color: #f9f9f9;
                border: 1px solid #ccc;
                border-radius: 6px;
                min-height: 40px;
                font-size: 13px;
                font-family: Arial, sans-serif;
            }

       .machine-line {
                padding: 2px 0;
                border-bottom: 1px dashed #ccc;
                color: #333;
            }

        .machine-line:last-child {
                border-bottom: none;
            }
         nav a img {
    height: 80px;
    vertical-align: middle;

}

.navbar-nav .nav-link {
    font-size: 14px; /* adjust to your desired size */
    font-weight: 500; /* optional: make it bold */
}                                                                   




    </style>
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
      <li class="nav-item"><a class="nav-link mx-2" href="new_form.php">Тоног.т</a></li>
    </ul>

    <!-- Right side (logout) -->
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link text-danger" href="login.php">Гарах</a></li>
    </ul>
  </div>
</nav>
    <form id = "myForm">


        
        <div class = "form-wrapper">

            <div class="label_input">
                    <label for="data_wrap">Дата сонгох</label>
                    <select id="data_wrap">
                        <option value="">-- Харах дата сонгох --</option>
                        <option value="project_data_wrap">Төслөөр</option>
                        <option value="buleg_data_wrap">Бүлгээр</option>
                        <option value="ded_buleg_data_wrap">Дэд бүлгээр</option>
                    </select>
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
                    <label for="project_group_number">Бүлэг дугаар</label>
                    <select id="project_group_number">
                        <option value="">-- Төсөл эхлээд сонгоно уу --</option>
                    </select>
                </div>

            

                <div class="label_input">
                    <label for="ded_buleg">Дэд бүлэг</label>
                    <select id="ded_buleg">
                        <option value="">-- Бүлэг эхлээд сонгоно уу. --</option>
                    </select>
                </div>

            

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
                <td>Нийт машин механизм цаг</td>
                <td><div id="uuriin_machine_hours" class="table-box"></div></td>
                <td><div id="tuslan_machine_hours" class="table-box"></div></td>
                <td><div id="turees_machine_hours" class="table-box"></div></td>
                </tr>
                        </tbody>
                    </table>
                </div>
                <div id = "machine_hours_display"></div>
            </div>
        </div>
    </form>

<script>
    document.getElementById("data_wrap").addEventListener("change", function () {
    
    var data_wrap = this.value;
    const project = document.getElementById("project");
    const label_project_group_number = document.querySelector('label[for="project_group_number"]');
    const select_project_group_number = document.getElementById("project_group_number");
    const label_ded_buleg = document.querySelector('label[for="ded_buleg"]');
    const select_ded_buleg = document.getElementById("ded_buleg");
    document.getElementById("uuriin_machine_hours").innerHTML = "";
    document.getElementById("turees_machine_hours").innerHTML = "";
    document.getElementById("tuslan_machine_hours").innerHTML = "";
    project.selectedIndex = 0;
        

    

    if (data_wrap === "project_data_wrap") {
        
        // project.selectedIndex = 0;
        // project.innerHTML = '<option value="">-- Төсөл сонгох --</option>';

        //project_group_number
        label_project_group_number.style.display = 'none';
        select_project_group_number.style.display = 'none';
        select_project_group_number.innerHTML = '<option value="">-- Төсөл эхлээд сонгоно уу --</option>';
        //ded_buleg
        label_ded_buleg.style.display = 'none';
        select_ded_buleg.style.display = 'none';
        select_ded_buleg.innerHTML = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';

        document.getElementById("uuriin_machine_hours").innerHTML = "";
        document.getElementById("turees_machine_hours").innerHTML = "";
        document.getElementById("tuslan_machine_hours").innerHTML = "";

    } else if  (data_wrap === "buleg_data_wrap") {
        // project.selectedIndex = 0;
        // project.innerHTML = '<option value="">-- Төсөл сонгох --</option>';

        //project_group_number
        label_project_group_number.style.display = 'block';
        select_project_group_number.style.display = 'block';
        select_project_group_number.innerHTML = '<option value="">-- Төсөл эхлээд сонгоно уу --</option>';


        //ded_buleg
        label_ded_buleg.style.display = 'none';
        select_ded_buleg.style.display = 'none';
        select_ded_buleg.value = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';

        document.getElementById("uuriin_machine_hours").innerHTML = "";
        document.getElementById("turees_machine_hours").innerHTML = "";
        document.getElementById("tuslan_machine_hours").innerHTML = "";
        
    } else if (data_wrap === "ded_buleg_data_wrap"){
        // project.selectedIndex = 0;
        // project.innerHTML = '<option value="">-- Төсөл сонгох --</option>';

        //project_group_number
        label_project_group_number.style.display = 'block';
        select_project_group_number.style.display = 'block';
        select_project_group_number.innerHTML = '<option value="">-- Төсөл эхлээд сонгоно уу --</option>';

         label_ded_buleg.style.display = 'block';
        select_ded_buleg.style.display = 'block';
        select_ded_buleg.value = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';

        document.getElementById("uuriin_machine_hours").innerHTML = "";
        document.getElementById("turees_machine_hours").innerHTML = "";
        document.getElementById("tuslan_machine_hours").innerHTML = "";

    }
});

    document.getElementById("project").addEventListener("change", function () {
        var projectName = this.value;

        document.getElementById("uuriin_machine_hours").innerHTML = "";
        document.getElementById("turees_machine_hours").innerHTML = "";
        document.getElementById("tuslan_machine_hours").innerHTML = "";

        if (projectName !== "") {
            fetch("get_project_id_1.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "project_name=" + encodeURIComponent(projectName)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);


                const select = document.getElementById("project_group_number");
                select.innerHTML = "";

                if (data["GroupNames"].length > 0) {
                    data["GroupNames"].forEach(id => {
                        let option = document.createElement("option");
                        option.value = id;
                        option.text = id;
                        select.appendChild(option);
                    });
                }


            
               const uuriin_container = document.getElementById("uuriin_machine_hours");
               const turees_container = document.getElementById("turees_machine_hours");
               const tuslan_container = document.getElementById("tuslan_machine_hours");
            //    container.innerHTML = ""; // Clear previous

            uuriin_container.innerHTML = '';
            tuslan_container.innerHTML = '';
            turees_container.innerHTML = '';

    // Render function
    // function renderTo(container, groupData) {
    //     for (const [machine, hours] of Object.entries(groupData)) {
    //         console.log("renders");
    //         const line = document.createElement('div');
    //         line.textContent = `${machine}: ${hours}`;
    //         console.log(line.textContent);
    //         container.appendChild(line);
    //     }
    // }

    function renderTo(container, groupData) {
    for (const [machine, hours] of Object.entries(groupData)) {
        const line = document.createElement('div');
        line.classList.add("machine-line");
        line.textContent = `${machine}: ${hours}`;
        container.appendChild(line);
    }
}



    if (data["Өөрийн"]) {
        renderTo(uuriin_container, data["Өөрийн"]);
    }

    if (data["Туслангийн"]) {
        renderTo(tuslan_container, data["Туслангийн"]);
    }

    if (data["Түрээс"]) {
        renderTo(turees_container, data["Түрээс"]);
    }
                // const select = document.getElementById("project_group_number");
                // select.innerHTML = "";

                // if (data.length > 0) {
                //     data.forEach(id => {
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

                
                // document.getElementById("ded_buleg").innerHTML = '<option value="">-- Бүлэг эхлээд сонгоно уу. --</option>';
            });
        }
    });

    document.getElementById("project_group_number").addEventListener("change", function () {
        var projects_buleg = this.value; // ded_buleg iig buleg bolgoh
        const project = document.getElementById("project").value;
        console.log("buleg avlaa");
        if (projects_buleg !== "") {
            fetch("get_ded_buleg_test_1.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                // body: "ded_buleg=" + encodeURIComponent(ded_buleg)

                body: `project=${encodeURIComponent(project)}&projects_buleg=${encodeURIComponent(projects_buleg)}`
            })
            .then(response => response.json())
            .then(data => {
               console.log(data);
               console.log("huleen avlaa");
               const uuriin_container = document.getElementById("uuriin_machine_hours");
               const turees_container = document.getElementById("turees_machine_hours");
               const tuslan_container = document.getElementById("tuslan_machine_hours");
            //    container.innerHTML = ""; // Clear previous

            uuriin_container.innerHTML = '';
            tuslan_container.innerHTML = '';
            turees_container.innerHTML = '';

    // Render function
    function renderTo(container, groupData) {
        for (const [machine, hours] of Object.entries(groupData)) {
            console.log("renders");
            const line = document.createElement('div');
            line.textContent = `${machine}: ${hours}`;
            console.log(line.textContent);
            container.appendChild(line);
        }
    }

    if (data["Өөрийн"]) {
        renderTo(uuriin_container, data["Өөрийн"]);
    }

    if (data["Туслангийн"]) {
        renderTo(tuslan_container, data["Туслангийн"]);
    }

    if (data["Түрээс"]) {
        renderTo(turees_container, data["Түрээс"]);
    }

               
            });
        }
    });
   
</script>

</body>
</html>
