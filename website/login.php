<?php
session_start();
require 'db_connect.php';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password, tusuv_oruulah FROM users WHERE username = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user, $stored_password, $tusuv_oruulah);
        $stmt->fetch();

        if ($password === $stored_password) {
            $_SESSION['user'] = [
                'username' => $user,
                'tusuv_oruulah' => $tusuv_oruulah
            ];
        
            if ($tusuv_oruulah == 1) {
                header("Location: new_form_test_1.php");
                exit;
            } else {
                header("Location: new_form_test_1.php");
                exit;
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
