






<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../Login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  
<!-- Bootstrap Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">🛡️ CyberSecure</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Login.html">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <br><br><br><br>

  <div class="dash">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>
  <p>Have you already reported? <a href="traking.php">Click here</a> to check.</p>
  <a href="logout.php">Logout</a><br>
  <a href="Report.html">Report here</a>
  </div>
</body>
</html>
