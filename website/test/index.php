<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Нэвтрэх</title>
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
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        .error {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Нэвтрэх</h2>
        <!-- Optional: Display error passed via URL -->
        <div class="error" id="error-message"></div>

        <form method="post" action="login.php">
            <input type="text" name="username" placeholder="Хэрэглэгчийн нэр" required>
            <input type="password" name="password" placeholder="Нууц үг" required>
            <input type="submit" value="Log In">
        </form>
    </div>

    <script>
        const params = new URLSearchParams(window.location.search);
        const error = params.get('error');
        if (error) {
            // Decode and show the actual error message from the URL
            document.getElementById('error-message').innerText = decodeURIComponent(error);
        }
    </script>
    
</body>
</html>
