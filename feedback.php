<?php
$servername = "localhost";
$username = "root";      // your DB username
$password = "";          // your DB password
$dbname = "cybersecure_db"; // your separate feedback DB

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the feedback from POST
$feedback_text = $_POST['feedback_text'];

// Insert into the database
$sql = "INSERT INTO feedback (feedback_text) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $feedback_text);

if ($stmt->execute()) {
    header("Location: Learn.html?feedback=success");
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
