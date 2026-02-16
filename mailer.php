<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
// require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/autoload.php';



function sendAcknowledgmentMail($toEmail, $tracking_id) {
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'secureportalteam123@gmail.com'; // sender email
        $mail->Password   = 'npof quyz cfey gaon';   // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('secureportalteam123@gmail.com', 'CipherWall Reports');
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your CipherWall Report Tracking ID';
        $mail->Body    = "
            <h3>Thank You for Reporting to CipherWall</h3>
            <p>We have received your report. Your tracking ID is:</p>
            <h2 style='color:#ff0000;'>$tracking_id</h2>
            <p>You can check the status here: 
                <a href='http://localhost/iicl-final/traking.php?id=$tracking_id'>Track Report</a>
            </p>
            <br>
            <p>- Team CipherWall</p>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        error_log("Email Error: {$mail->ErrorInfo}");
        return false;
    }
}
?>
