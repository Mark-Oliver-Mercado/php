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
    <a href="javascript:void(0)" class="logout" onclick="toggleDropdown()"></a>

<div id="dropdown" class="dropdown-content">
    <a href="../php/profile.php">Profile</a>
    <a href="../php/settings.php">Settings</a>
    <a href="../php/logout.php">Logout</a>
</div>
    <!-- <a class="logout" href="../php/logout.php"></a> -->
    <!-- <div class="bg">
        <label class="custom-file-upload">
            Upload Your Desired Background
            <input type="file" id="backgroundImageInput" accept="image/*" onchange="setBackgroundImage(event)" />
        </label>
    </div> -->
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
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/select_age.php'">
            <h1>Origami</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/video_select.php'">
            <h1>Letter Making</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/card_select.php'">
            <h1>Notepad</h1>
        </div>
        
    </div>
</section>


<script>
    // Toggle the dropdown menu when the logout button is clicked
function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("show");
}

// Close the dropdown if the user clicks anywhere outside of it
window.onclick = function(event) {
    if (!event.target.matches('.logout') && !event.target.matches('.dropdown-content') && !event.target.matches('.dropdown-content a')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>
</body>
</html>
