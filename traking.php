<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="traking.css">
    <title>Track report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body>

    <!-- Bootstrap Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">🛡️ CipherWall </a>
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
    
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          
          <div class="contain">x
          <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
              <h4 class="card-title mb-3">Track Your Report</h4>
              <form method="POST" action="traking.php">
                        <div class="mb-3">
                            <label class="form-label">Enter Tracking ID:</label>
                            <input type="text" name="tracking_id" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Track</button>
                    </form>
                </div>
            </div>
          </div>

            
            <?php
            include 'dbconnect.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $tracking_id = $_POST['tracking_id'];
                $stmt = $conn->prepare("SELECT * FROM reports WHERE tracking_id = ?");
                $stmt->bind_param("s", $tracking_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $report = $result->fetch_assoc();
                    echo "<div class='card shadow-sm'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title text-success'>Report Found</h5>";
                    echo "<p><strong>Name:</strong> " . htmlspecialchars($report['full_name']) . "</p>";
                    echo "<p><strong>Status:</strong> " . htmlspecialchars($report['status']) . "</p>";
                    echo "<p><strong>Details:</strong> " . nl2br(htmlspecialchars($report['report_details'])) . "</p>";
                    echo "</div></div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>No report found for that Tracking ID.</div>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
</div>













