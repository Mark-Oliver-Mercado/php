<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<header>
    <h2>Welcome to Your Dashboard, <?php echo $_SESSION['username']; ?>!</h2>
    <a class="logout" href="../php/logout.php">Logout</a>
    <div class="bg">
        <label class="custom-file-upload">
            Upload Your Desired Background
            <input type="file" id="backgroundImageInput" accept="image/*" onchange="setBackgroundImage(event)" />
        </label>
    </div>
</header>
<section>
    <div class="display1">
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/select_age.php'">
            <h1>Quizzes</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/video_select.php'">
            <h1>Videos</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/card_select.php'">
            <h1>Fill in the blank</h1>
        </div>
    </div>
</section>
<script>
    function setBackgroundImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.body.style.backgroundImage = `url(${e.target.result})`;
                // Save the background image URL in local storage
                localStorage.setItem('backgroundImage', e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            console.error('No file selected.');
        }
    }

    function loadBackgroundImage() {
        const backgroundImage = localStorage.getItem('backgroundImage');
        if (backgroundImage) {
            document.body.style.backgroundImage = `url(${backgroundImage})`;
            console.log('Background image loaded from local storage:', backgroundImage);
        } else {
            console.log('No background image found in local storage.');
        }
    }

    // Load the background image when the page loads
    window.onload = loadBackgroundImage;
</script>
</body>
</html>
