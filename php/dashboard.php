<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
include '../php/config.php';

// Fetch the user's profile image
$user_id = $_SESSION['id'];
$query = "SELECT profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($profileImagePath);
$stmt->fetch();
$stmt->close();

// Set a default image if no profile picture is set
$profileImagePath = $profileImagePath ? '../uploads/' . $profileImagePath : 'default-profile.png';

// Retrieve the theme color from session
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue if no theme is set
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- Dynamically link the CSS for the selected theme -->
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
</head>

<body>
    <header>
        <h2>Welcome to Your Dashboard, <?php echo $_SESSION['username']; ?>!</h2>
        <!-- Add the dynamic background image directly to the logout button -->
        <a href="javascript:void(0)" class="logout" onclick="toggleDropdown()" style="background-image: url('<?php echo $profileImagePath; ?>');"></a>

        <div class="logo">
            <a href="#" class="d-flex">
                <img src="../images/logo eels.png" alt="Logo" id="logo">
            </a>
        </div>

        <div id="dropdown" class="dropdown-content">
            <a href="../php/profile.php">Profile</a>
            <a href="../php/history.php">History</a>
            <a href="../php/settings.php">Settings</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </header>
    <section>
        <div class="display1">
            <div class="display-quiz" onclick="window.location.href='http://localhost/EELS/php/select_age.php'">
                <h1>Quizzes</h1>
            </div>
            <div class="display-video" onclick="window.location.href='http://localhost/EELS/php/video_select.php'">
                <h1>Videos</h1>
            </div>
            <div class="display-iden" onclick="window.location.href='http://localhost/EELS/php/card_select.php'">
                <h1> Identification </h1>
            </div>
            <div class="display-origami" onclick="window.location.href='http://localhost/EELS/php/origami.php'">
                <h1>Origami</h1>
            </div>
            <div class="display-letter" onclick="window.location.href='http://localhost/EELS/php/letter_making.php'">
                <h1>Letter Making</h1>
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