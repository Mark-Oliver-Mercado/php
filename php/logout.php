<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require '../vendor/autoload.php';

session_start();

if (isset($_GET['confirm'])) {
    if ($_GET['confirm'] === 'yes') {
        // Check if the session email exists
        if (!isset($_SESSION['email'])) {
            echo 'Session email not set';
            exit();
        }

        $user_email = $_SESSION['email'];
        session_unset();  // Unset session variables
        session_destroy(); // Destroy session

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Mail settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Gmail's SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'markolivermercado101@gmail.com'; // Your Gmail address
            $mail->Password   = 'xbqe hoqc kigr qmhv';  // Gmail App Password
            $mail->Port = 465; // For SSL
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption


            // Recipients
            $mail->setFrom('markolivermercado101@gmail.com', 'Mailer');
            $mail->addAddress($user_email); // Add recipient email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Logout Confirmation';
            $mail->Body    = 'Hello, you have successfully logged out from your account.';

            // Send the email
            $mail->send();
            echo "<script>alert('Logout successful. A confirmation email has been sent to $user_email.');</script>";
            header("Refresh: 2; url=mainpage.php");
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } elseif ($_GET['confirm'] === 'no') {
        // Redirect to the dashboard if the user chooses "No"
        header("Location: mainpage.php");
        exit();
    }
} else {
    // If no confirmation parameter is set, display the confirmation form
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout Confirmation</title>
        <link rel="stylesheet" href="../css/logout.css">
    </head>

    <body>
        <div class="container">
            <h2>Logout Confirmation</h2>
            <p>Are you sure you want to log out?</p>
            <div class="buttons">
                <a href="?confirm=yes" class="btn confirm">Yes</a>
                <a href="?confirm=no" class="btn cancel">No</a>
            </div>
        </div>
    </body>

    </html>
<?php
}
?>