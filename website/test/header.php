<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$username = $_SESSION['user']['username'] ?? '';
?>


<!DOCTYPE html>
<html lang="mn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Header CSS only -->
    <link rel="stylesheet" href="header_style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light px-4">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="tuvshin_logo.png" alt="Logo" class="me-2" height="45">
            <!-- <span class="fw-bold text-primary">Tuvshingegee</span> -->
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="projectDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Төсөл</a>
                    <ul class="dropdown-menu" aria-labelledby="projectDropdown">
                        <li><a class="dropdown-item" href="view_project_budget_2.php">Жагсаалт</a></li>
                        <li><a class="dropdown-item" href="enter_project_name.html">Оруулах</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link mx-2" href="new_form_css_test_1.php">Гүйцэтгэл</a></li>
                <li class="nav-item"><a class="nav-link mx-2" href="view_new_form_test_1.php">Тайлан</a></li>
                <li class="nav-item"><a class="nav-link mx-2" href="machine.php">Мэдээллэл</a></li>
            </ul>
          

           <ul class="navbar-nav ms-auto align-items-center">
        <!-- Username display -->
        <li class="nav-item me-3">
            <span class="nav-link username-display">
                Сайн байна уу, <strong><?= htmlspecialchars($username) ?></strong>
                    </span>
                </li>
            
                <!-- Logout button -->
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Гарах</a>
                </li>
            </ul>

        </div>
    </nav>

   