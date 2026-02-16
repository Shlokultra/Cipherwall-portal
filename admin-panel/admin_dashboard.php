<?php
include 'db_connect.php';

// Check login
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CipherWall</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #141e30 0%, #243b55 100%);
            color: #f5faff;
            margin: 0;
            min-height: 100vh;
        }
        .navbar {
            background: rgba(20, 30, 48, 0.98) !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.18);
        }
        .navbar-brand {
            font-weight: bold;
            color: #00bcd4 !important;
            letter-spacing: 1px;
            font-size: 1.3rem;
        }
        .container {
            max-width: 900px;
            background: rgba(31, 46, 74, 0.97);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 40px 30px;
            margin-top: 40px;
        }
        h2 {
            color: #00bcd4;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 24px;
            text-shadow: 0 2px 4px rgba(0,188,212,0.3);
        }
        .welcome-card {
            background: rgba(31, 46, 74, 0.8);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #00bcd4;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            padding: 10px 24px;
            transition: background 0.3s;
            margin-right: 10px;
        }
        .btn-custom:hover {
            background-color: #0097a7;
            color: #fff;
        }
        footer {
            background: #141e30;
            color: #b0bec5;
            text-align: center;
            padding: 18px 0;
            margin-top: 40px;
            border-radius: 0 0 12px 12px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 18px 8px;
                margin-top: 18px;
            }
            .btn-custom {
                display: block;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">🛡️ CipherWall Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_complaints.php">View Reports</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_user']); ?> 👋</h2>
            <p>Manage reports and oversee the CipherWall platform.</p>
        </div>
        <a href="view_complaints.php" class="btn btn-custom">📋 View Complaints</a>
        <a href="logout.php" class="btn btn-custom">🚪 Logout</a>
    </div>

    <footer>
        <p>&copy; 2025 CipherWall | Admin Panel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>