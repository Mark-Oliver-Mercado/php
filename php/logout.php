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
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if a confirmation parameter is provided in the URL
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    // Destroy session if user confirms "Yes"
    session_destroy(); // Destroy all session data
    header("Location: mainpage.php"); // Redirect to login page
    exit();
} elseif (isset($_GET['confirm']) && $_GET['confirm'] === 'no') {
    // Redirect to home page if user chooses "No"
    header("Location: dashboard.php"); // Redirect to home page or any other page
    exit();
}
?>
