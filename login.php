<?php
session_start();
require "db_connect.php";

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT username, password, tusuv_oruulah FROM users WHERE username = ?");
    if ($stmt) {
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
                    header("Location: home_budgetAdmin.html");
                    exit;
                } else {
                    header("Location: view_project.php");
                    exit;
                }
            } else {
                $error = "Нэвтрэх нэр эсвэл нууц үг буруу байна.";
            }
        } else {
            $error = "Нэвтрэх нэр эсвэл нууц үг буруу байна..";
        }

        $stmt->close();
    } else {
        $error = "Database error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        input[type="submit"] {
            width: 100%;
            background: #007BFF;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Нэвтрэх нэр" required>
            <input type="password" name="password" placeholder="Нууц үг" required>
            <input type="submit" value="Нэвтрэх">
        </form>
    </div>
</body>
</html>
