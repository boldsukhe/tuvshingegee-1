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
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px 30px;
            margin-top: 20px;
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
        input[type="date"]
         {
            padding: 8px 10px;
            border-radius: 4px;
            border : 1px solid #ccc;
         }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            height: 36px;         /* 🔹 same height for all */
            line-height: 18px;
            font-size: 13px;
            box-sizing: border-box;
                }
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
       
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
        .table-input {
    width: 100%;
    box-sizing: border-box;
}
table.styled-table td {
    vertical-align: top;
    padding: 8px; /* optional, adjust spacing */
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
         select:focus {
            border-color: #007bff;
            outline: none;
        }
        select {
            padding: 8px 10px;
            font-size: 13px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
       
       
/* Make sure select2 takes full width of the cell */
td select.select2 {
    width: 100% !important;
    box-sizing: border-box;
}

/* Multi-select selected items should wrap and not expand the select */
.select2-container--default.select2-container--open {
    width: 100% !important;
}

.select2-selection--multiple {
    min-height: 36px; /* match your inputs */
    max-width: 100%;  /* do not exceed cell */
    display: flex;
    flex-wrap: wrap;  /* wrap selected items */
    align-items: center;
    box-sizing: border-box;
}

.select2-selection__rendered {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
}

.select2-search--inline {
    flex: 1 1 auto;
    min-width: 50px;
}

nav {
   
    display: flex;
    align-items: center;
    padding: 10px 70px;
    gap: 35px;  /* spacing between logo and links */
    background-color: #ffffff;
    border-bottom: 1px solid #e0e0e0;
}

nav a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 13px;
}

nav a:hover {
    text-decoration: underline;
}

nav a img {
    height: 80px;
    vertical-align: middle;

}

/* Push logout to far right */
nav a.logout {
    margin-left: auto;
}
nav .nav-links a:first-of-type {
    margin-left: 0px; /* adjust the number as you like */
}

.navbar-nav .nav-link {
    font-size: 14px; /* adjust to your desired size */
    font-weight: 500; /* optional: make it bold */
}
.wrapping_cont {
    display: flex;
    gap: 20px;            /* nice spacing between them */
}

.wrapping_cont .label_input {
    flex: 1;              /* each takes equal width */
    min-width: 0;         /* prevent flexbox overflow */
}

.wrapping_cont input,
.wrapping_cont select {
    width: 100%;          /* input stretches inside its parent */
    box-sizing: border-box;
}
/* Wrap select + div in flex column */
.machine_wrapper {
    display: flex;
    flex-direction: column;
    align-items: stretch;  /* stretch to full width */
}

/* Make Select2 multi-select width 100% */
.machine_wrapper select.select2 {
    width: 100% !important;
    box-sizing: border-box;
}

/* Ensure the <div> below always starts immediately after the select */
.machine_wrapper div {
    margin-top: 4px; /* optional spacing */
}

/* Optional: ensure table cells align to top */
.styled-table td {
    vertical-align: top;
}



    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light px-4">
  <a class="navbar-brand" href="#">
    <img src="tuvshin_logo.png" alt="Logo" height="50">
  </a>

  <!-- Toggler button -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-3">
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="projectDropdown" role="button" 
           data-bs-toggle="dropdown" aria-expanded="false">
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



<form action="save_new_form_test_1.php" method="POST">
    <div class="box_header">
        <h3>Маягт</h3>
    </div>

    
    
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
            <label for="project_group_number">Бүлгийн дугаар</label>
            <select id="project_group_number" name="project_group_number" style="width: 100%;">
                <option value=""></option>
            </select>
        </div>
      
        <div class="label_input">
            <label for="ded_buleg">Дэд бүлэг</label>
            <select id="ded_buleg" name="ded_buleg">
                <option value="">-- Бүлэг эхлээд сонгоно уу. --</option>
            </select>
        </div>
    

        <div class="wrapping_cont">
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
            <div class = "machine_wrapper">
            <select id="uuriin_machine" name="uuriin_machine[]" multiple class="select2"> 
                <?php foreach ($machines as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
             <div id="uuriin_machine_tsag" style="margin-top: 10px;"></div>
                </div>
        </td>
        <td>
            <div class = "machine_wrapper">
             <select id="tuslan_machine" name="tuslan_machine[]" multiple class="select2">
                <?php foreach ($machines as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
            <div id="tuslan_machine_tsag" style="margin-top: 10px;"></div>
                </div>
        </td>
        <td>
            <div class = "machine_wrapper">
           <select id="turees_machine" name="turees_machine[]" multiple class="select2">
                <?php foreach ($machines as $name): ?>
                    <option value="<?= htmlspecialchars($name) ?>"><?= htmlspecialchars($name) ?></option>
                <?php endforeach; ?>
            </select>
            <div id="turees_machine_tsag" style="margin-top: 10px;"></div>
                </div>
        </td>
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
                            console.log(item);
                            let option = document.createElement("option");
                            option.value = item.group_number;      // internal value
                            option.textContent = item.group_number; // visible label
                            select.appendChild(option);
                        });
                
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
        
        var ded_buleg = this.value; //ded_buleg ni bulegiin names bolno. гэр барих - 250601
        console.log(ded_buleg);
        if (ded_buleg !== "") {
            fetch("get_ded_buleg_number.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "ded_buleg=" + encodeURIComponent(ded_buleg)
            })
            .then(response => response.json())
            .then(data => {
                // const buleg_utga = document.getElementById("buleg_utga");
                // const buleg_utga_display = document.getElementById("buleg_utga_display");
                
                // console.log(data.buleg_id);
                // buleg_utga.value = data.buleg_id || "No description";
                // buleg_utga_display.textContent = data.buleg_id || "No description";
                
                ////////////////////////////////////////////////////////////////////
                    const select = document.getElementById("ded_buleg");
                    select.innerHTML = "";

                    data.forEach(item => {
                        let option = document.createElement("option");
                        option.value = item.id;
                        option.text = item.text;
                        select.appendChild(option);
                    });

                
                
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
        allowClear: false
    });
});    
     $(document).ready(function () 
     {
        $('#uuriin_machine').select2({ placeholder: "" });
        $('#tuslan_machine').select2({ placeholder: "" });
        $('#turees_machine').select2({ placeholder: "" });
     });
     

$('#uuriin_machine').on('change', function () {
    const selectedMachines = $(this).val(); // array of selected values
    const container = $('#uuriin_machine_tsag');
    container.empty(); // Clear existing inputs

    if (selectedMachines) {
        selectedMachines.forEach(function (machine) {
            const inputGroup = `
                <div style="margin-bottom: 8px;">
                    <label>${machine}:</label>
                    <input type="number" name="uuriin_machine_tsag[${machine}]" placeholder="Машин цаг" >
                </div>
            `;
            container.append(inputGroup);
        });
    }
});

$('#turees_machine').on('change', function () {
    const selectedMachines = $(this).val(); // array of selected values
    const container = $('#turees_machine_tsag');
    container.empty(); // Clear existing inputs

    if (selectedMachines) {
        selectedMachines.forEach(function (machine) {
            const inputGroup = `
                <div style="margin-bottom: 8px;">
                    <label>${machine}:</label>
                    <input type="number" name="turees_machine_tsag[${machine}]" placeholder="Машин цаг" style="width: 100%; padding: 5px; margin-top: 4px;">
                </div>
            `;
            container.append(inputGroup);
        });
    }
});

$('#tuslan_machine').on('change', function () {
    const selectedMachines = $(this).val(); // array of selected values
    const container = $('#tuslan_machine_tsag');
    container.empty(); // Clear existing inputs

    if (selectedMachines) {
        selectedMachines.forEach(function (machine) {
            const inputGroup = `
                <div style="margin-bottom: 8px;">
                    <label>${machine}:</label>
                    <input type="number" name="tuslan_machine_tsag[${machine}]" placeholder="Машин цаг" style="width: 100%; padding: 5px; margin-top: 4px;">
                </div>
            `;
            container.append(inputGroup);
        });
    }
});

</script>

</body>
</html>
