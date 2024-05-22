<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your logic to generate and send the confirmation code
    $userEmail = $_POST['email'];
    $confirmationCode = generateConfirmationCode(); // Replace this with your actual logic

    // Your logic to send the confirmation email
    $emailSent = sendConfirmationEmail($confirmationCode, $userEmail); // Pass the email as an argument

    // Simulate a response, you can customize this based on your actual implementation
    if ($emailSent) {
        $response = [
            'success' => true,
            'code' => $confirmationCode,
            'message' => 'Confirmation code sent successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Error sending confirmation code email.'
        ];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Function to generate a confirmation code (replace with your actual logic)
function generateConfirmationCode() {
    // Your code generation logic goes here
    return rand(0000,9999); // Replace with your actual code
}

// Function to send a confirmation email (replace with your actual logic)
function sendConfirmationEmail($confirmationCode, $email) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Set to SMTP::DEBUG_SERVER for debugging
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'howto4prob@gmail.com'; // Your Gmail address
        $mail->Password   = 'ddlbukjchdoadplp'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('abdelfatahmennoun@gmail.com', 'Hkayn');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation Code';
        $mail->Body    = 'Your confirmation code is: ' . $confirmationCode;

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the error or handle it as needed
        return false;
    }
}

// sendConfirmationEmail(generateConfirmationCode(), 'mennoun@');
?>
