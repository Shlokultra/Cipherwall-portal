<?php
include 'dbconnect_lo.php';

if (isset($_POST['submit'])) {
    $recaptchaSecret = '6LcSA5krAAAAAOZZHCJagPLgdlzCFFLMa9pZ5mFW';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $verifyResponse = file_get_contents(
        "https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse
    );
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        die("reCAPTCHA verification failed. Please try again.");
    }


    $full_name = ($_POST['name']);
    $email = ($_POST['email']);
    $mobile = ($_POST['mobile']);
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);
    $dob = ($_POST['dob']);
    $security_question = ($_POST['security_question']);
    $security_answer = ($_POST['security_answer']);
    $agree_term = isset($_POST['agree_terms']) ? 1 : 0;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
    die("Invalid email format.");
    }
if (!preg_match('/^[0-9]{10}$/', $mobile)) 
    {
    die("Invalid mobile number.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "Email already registered. Please use a different one.";
        $check_stmt->close();
        $conn->close();
        exit();
    }
    $check_stmt->close();

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, mobile_number, password_hash, date_of_birth, security_question,security_answer, agreed_to_terms)
            VALUES (?, ?, ?, ?, ?, ?, ?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $full_name, $email, $mobile, $password_hash, $dob, $security_question,$security_answer, $agree_term);

    if ($stmt->execute()) {
        header("Location: Login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
