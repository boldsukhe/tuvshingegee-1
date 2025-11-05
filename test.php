

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

<form action="save_new_form.php" method="POST">
    <div class="box_header">
        <h3>Маягт</h3>
    </div>

    <div class="form-grid">

     

        <!-- <div class="label_input">
            <label for="project-id">Бүлэг дугаар</label>
            <select id="project_group_number" name="project_group_number">
                <option value="">-- Төсөл эхлээд сонгоно уу --</option>
            </select>
        </div> -->

        <div class="label_input">
            <label for="project_group_number">Бүлэг дугаар</label>
            <select id="project_group_number" name="project_group_number" style="width: 100%;">
                <option value="гэр барих - 250601">гэр барих - 250601</option>
                <option value="гэр буулгах - 111111">гэр буулгах - 111111</option>
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

</div>


<script>


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
$(document).ready(function () {
    $('#project_group_number').select2({
        placeholder: "-- Бүлэг дугаар сонгоно уу --",
        allowClear: true
    });
});
    
</script>

</body>
</html>
