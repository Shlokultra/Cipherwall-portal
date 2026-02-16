<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
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
</body>
</html>
<br><br><br><br><br><br>


<?php


    session_start();
    include 'dbconnect_lo.php';
    // include 'mailer.php';

    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        if(!isset($_SESSION['userid']))
        {
            die("Please login to report the incident.");
        }
        $user_id = $_SESSION['userid'];



        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $incident_type = $_POST['incident_Type'];
        $incident_date = $_POST['incident_date'];
        $description = $_POST['description'];

        //tarcking id

        $date = date("ymd");
        $random = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"),0,6);
        $tracking_id = "REP-$date-$random";




        $evidence_file = null;
        if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] === UPLOAD_ERR_OK) 
        {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $filename = basename($_FILES['evidence']['name']);
        $target_path = $upload_dir . time() . "_" . $filename;

        if (move_uploaded_file($_FILES['evidence']['tmp_name'], $target_path)) {
            $evidence_file = $target_path;
        } else {
            die("Failed to upload file.");
        }
        }


        $stmt = $conn->prepare("INSERT INTO reports (
        user_id,tracking_id, full_name, email, phone_number,
        incident_type, incident_date, description, evidence_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");

         $stmt->bind_param("issssssss", $user_id,$tracking_id, $full_name, $email, $phone_number, $incident_type, $incident_date, $description, $evidence_file);

         if ($stmt->execute()) {
        echo "<p style='color:green;'>Report submitted successfully!</p>";
        echo "<p><strong>Your Tracking ID:</strong> $tracking_id</p>";
        echo "<p><strong>keep this tracking ID for future reference</strong></p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();

    }




?>