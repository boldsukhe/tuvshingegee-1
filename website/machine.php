<?php
require "db_connect.php";

// Fetch machine data
$sql = "SELECT * FROM machine";
$result = $conn->query($sql);
$data = [];
if ($result && $result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Машин механизм</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
  <a class="navbar-brand" href="#">
    <img src="tuvshin_logo.png" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="projectDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Төсөл
        </a>
        <ul class="dropdown-menu" aria-labelledby="projectDropdown">
          <li><a class="dropdown-item" href="view_project_budget_2.php">Жагсаалт</a></li>
          <li><a class="dropdown-item" href="enter_project_name.html">Оруулах</a></li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="new_form_test_1.php">Маягт</a></li>
      <li class="nav-item"><a class="nav-link" href="view_new_form_test_1.php">Гүйцэтгэл</a></li>
      <li class="nav-item"><a class="nav-link" href="machine.php">Тоног.т</a></li>
    </ul>

    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link text-danger" href="login.php">Гарах</a></li>
    </ul>
  </div>
</nav>

<!-- Table -->
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title mb-4">Машин механизм</h4>
            <div class="table-responsive">
                <style>
/* Input widths per column */
.input-id {
    width: 90%;  /* almost full width of td */
}

.input-mark {
    width: 95%;
}

.input-origin {
    width: 90%;
}

.input-capacity {
    width: 90%;
}

.input-license {
    width: 95%;
}
</style>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:10%;">д/д</th>
            <th style="width:40%;">Марк</th>
            <th style="width:20%;">Гарал үүсэл</th>
            <th style="width:20%;">Хүчин чадал</th>
            <th style="width:10%;">Улсын дугаар</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <?php foreach ($data as $row): ?>
        <tr>
            <td><input type="text" class="form-control form-control-sm input-id" 
                       name="numbers[]" value="<?= htmlspecialchars($row['id']) ?>" required></td>
            <td><input type="text" class="form-control form-control-sm input-mark" 
                       name="mark[]" value="<?= htmlspecialchars($row['name']) ?>" required></td>
            <td><input type="text" class="form-control form-control-sm input-origin" 
                       name="license_plate[]" value="<?= htmlspecialchars($row['license_plate']) ?>" required></td>
            <td><input type="text" class="form-control form-control-sm input-capacity" 
                       name="capacity[]" value="<?= htmlspecialchars($row['capacity']) ?>" readonly></td>
            <td><input type="text" class="form-control form-control-sm input-license" 
                       name="manufacture[]" value="<?= htmlspecialchars($row['manufacture']) ?>" required></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
</html>
