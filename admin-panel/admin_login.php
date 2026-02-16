<?php
// session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['admin_user'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - CipherWall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #141e30 0%, #243b55 100%);
            color: #f5faff;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .navbar {
            background: rgba(20, 30, 48, 0.98) !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.18);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-brand {
            font-weight: bold;
            color: #00bcd4 !important;
            letter-spacing: 1px;
            font-size: 1.3rem;
        }
        .login-container {
            background: rgba(31, 46, 74, 0.97);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            margin-top: 80px;
        }
        h2 {
            color: #00bcd4;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 24px;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0,188,212,0.3);
        }
        .form-label {
            color: #e0f7fa;
        }
        .form-control {
            background: rgba(255,255,255,0.07);
            border: 1px solid #00bcd4;
            color: #fff;
        }
        .form-control:focus {
            background: rgba(0,188,212,0.07);
            border-color: #38a169;
            box-shadow: 0 0 0 0.2rem rgba(0,188,212,0.25);
        }
        .btn-custom {
            background-color: #00bcd4;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            padding: 10px 24px;
            transition: background 0.3s;
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #0097a7;
            color: #fff;
        }
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            color: #f8d7da;
        }
        footer {
            background: #141e30;
            color: #b0bec5;
            text-align: center;
            padding: 18px 0;
            margin-top: 40px;
            border-radius: 0 0 12px 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        @media (max-width: 768px) {
            .login-container {
                padding: 18px 8px;
                margin-top: 60px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🛡️ CipherWall Admin</a>
        </div>
    </nav>

    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 CipherWall | Admin Panel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>