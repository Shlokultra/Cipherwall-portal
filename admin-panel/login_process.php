<?php
include 'db_connect.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // For now, plain-text password check (Replace with password_hash later)
        if ($password === $row['password']) {
            $_SESSION['admin_user'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit();
        }
    }

    // Failed login
    header("Location: admin_login.php?error=Invalid Credentials");
    exit();
}
?>

