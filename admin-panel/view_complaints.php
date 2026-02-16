<?php
include 'db_connect.php';

// Protect page
if (!isset($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit();
}

// Connect to reportingdb instead of admin-panel
$reportingConn = new mysqli("localhost", "root", "", "reporting_db");
if ($reportingConn->connect_error) {
    die("Connection failed: " . $reportingConn->connect_error);
}

$sql = "SELECT * FROM reports ORDER BY submitted_at DESC";
$result = $reportingConn->query($sql);

if (!$result) {
    die("Query Failed: " . $reportingConn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports - Admin Panel</title>
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
            max-width: 1200px;
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
        .btn-secondary {
            background-color: #00bcd4;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 6px;
            padding: 10px 24px;
            transition: background 0.3s;
        }
        .btn-secondary:hover {
            background-color: #0097a7;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #00bcd4;
        }
        th {
            background-color: #1f2e4a;
            color: #00bcd4;
            font-weight: 600;
        }
        td {
            color: #e0f7fa;
        }
        tr:hover {
            background-color: rgba(0,188,212,0.1);
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
            table {
                font-size: 0.9rem;
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
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">View Reports</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>All Reports</h2>
        <a href="admin_dashboard.php" class="btn btn-secondary">⬅ Back to Dashboard</a>
        <br><br>

        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Reporter Name</th>
                        <th>Report Content</th>
                        <th>Date Submitted</th>
                        <th>Tracking ID</th>
                        <th>Email</th>
                        <th>Incident Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['report_id']); ?></td>
                        <td><?= htmlspecialchars($row['full_name']); ?></td>
                        <td><?= nl2br(htmlspecialchars($row['description'])); ?></td>
                        <td><?= htmlspecialchars($row['submitted_at']); ?></td>
                        <td><?= htmlspecialchars($row['tracking_id']); ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['incident_type']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 CipherWall | Admin Panel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>