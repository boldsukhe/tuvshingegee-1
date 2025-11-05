<?php
require "db_connect.php";


// if (isset($_GET['ajliin_dugaar'])) {
//     echo "The selected ajliin_dugaar is: " . htmlspecialchars($_GET['ajliin_dugaar']);
//     echo "The selected id is: " .htmlspecialchars($_GET['tusuv_id'] ."   ");
// } else {
//     echo "No group selected.";
// }

$ded_buleg_id = $_GET['ded_buleg_id'];
$tusuv_id = $_GET['tusuv_id'];
$ajliin_dugaar = $_GET['ajliin_dugaar'];
$conn->close();
echo '<nav>';
    echo '<a href="./view_project_budget.php">төсөл харах</a>';
echo '<nav>';
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Форм</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    grid-template-columns: 1fr 1fr 1fr; /* 3 columns */
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
    text-align: left;
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

    </style>
</head>
<body>



<form action="save_ajilbar_form.php" method="post">
    <!-- Hidden Inputs -->
    <input type="hidden" name="ded_buleg_id" value="<?php echo htmlspecialchars($_GET['ded_buleg_id'] ?? ''); ?>">
    <input type="hidden" name="tusuv_id" value="<?php echo htmlspecialchars($_GET['tusuv_id'] ?? ''); ?>">
    <input type="hidden" name="ajliin_dugaar" value="<?php echo htmlspecialchars($_GET['ajliin_dugaar'] ?? ''); ?>">

    <div class="box_header">
        <!-- <img src="tuvshin_logo.png" alt="tuvshingegee logo"> -->
        <h3>Барилга угсралтын ажлын акт</h3>
    </div>

    <div class="form-grid">
        <div class="label_input">
            <label for="ner">Таны нэр</label>
            <input type="text" id="ner" name="ner">
        </div>

        <div class="label_input">
            <label for="udriin_tuluv">Өдрийн төлөв</label>
            <input type="date" id="udriin_tuluv" name="udriin_tuluv">
        </div>

        <div class="label_input">
            <label for="geodyse_hyanalt">Геодези хяналт</label>
            <select name="geodyse_hyanalt" id="geodyse_hyanalt">
                <option value="Тийм">Тийм</option>
                <option value="Үгүй">Үгүй</option>
            </select>
        </div>

        <div class="label_input">
            <label for="mashin_mechanism_uuriin">Өөрийн машин механизм</label>
            <select name="mashin_mechanism_uuriin" id="mashin_mechanism_uuriin">
                <option value="Индүү">Индүү</option>
                <option value="Усны машин">Усны машин</option>
            </select>
        </div>

        <div class="label_input">
            <label for="mashin_mechanism_uuriin_tsag">Өөрийн машин механизм цаг</label>
            <input type="number" id="mashin_mechanism_uuriin_tsag" name="mashin_mechanism_uuriin_tsag">
        </div>

        <div class="label_input">
            <label for="mashin_mechanism_turees">Түрээс машин механизм</label>
            <select name="mashin_mechanism_turees" id="mashin_mechanism_turees">
                <option value="Индүү">Индүү</option>
                <option value="Усны машин">Усны машин</option>
            </select>
        </div>

        <div class="label_input">
            <label for="mashin_mechanism_turees_tsag">Түрээс машин механизм цаг</label>
            <input type="number" id="mashin_mechanism_turees_tsag" name="mashin_mechanism_turees_tsag">
        </div>

        <div class="label_input">
            <label for="ajillasan_uuriin_hun">Ажилласан өөрийн хүн</label>
            <select name="ajillasan_uuriin_hun" id="ajillasan_uuriin_hun">
                <option value="Б.Дорж">Б.Дорж</option>
                <option value="Ц.Өнөр">Ц.Өнөр</option>
            </select>
        </div>

        <div class="label_input">
            <label for="ajillasan_turees_hun">Ажилласан түрээс хүн</label>
            <select name="ajillasan_turees_hun" id="ajillasan_turees_hun">
                <option value="Ж.Тулга">Ж.Тулга</option>
                <option value="Н.Хонгор">Н.Хонгор</option>
            </select>
        </div>

        <div class="label_input">
            <label for="ashiglasan_material">Ашигласан материал</label>
            <input type="text" id="ashiglasan_material" name="ashiglasan_material">
        </div>

        <div class="label_input">
            <label for="material_too_hemjee">Тоо хэмжээ</label>
            <input type="text" id="material_too_hemjee" name="material_too_hemjee">
        </div>

        <div class="label_input">
            <label for="hyanalt_hiigdsen_eseh">Хяналт хийгдсэн эсэх</label>
            <select name="hyanalt_hiigdsen_eseh" id="hyanalt_hiigdsen_eseh">
                <option value="тийм">Тийм</option>
                <option value="үгүй">Үгүй</option>
            </select>
        </div>

        <div class="label_input full-width">
            <label for="anhaarah_zuil">Анхаарах зүйл</label>
            <input type="text" id="anhaarah_zuil" name="anhaarah_zuil">
        </div>

        <div class="label_input full-width">
            <label for="tailbar">Тайлбар</label>
            <input type="text" id="tailbar" name="tailbar">
        </div>
    </div>

    <div class="button">
        <button type="submit">Мэдээлэл оруулах</button>
    </div>
</form>

</body>
</html>


