<?php
session_start();
include '../php/config.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Handle profile image upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {
    $user_id = $_SESSION['id'];
    $profileImage = $_FILES['profileImage'];

    // Define the upload directory and allowed file types
    $uploadDir = '../uploads/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Validate the file type
    if (in_array($profileImage['type'], $allowedTypes)) {
        $imageExtension = pathinfo($profileImage['name'], PATHINFO_EXTENSION);
        $newImageName = $user_id . '.' . $imageExtension; // Use user ID to avoid filename conflicts
        $uploadPath = $uploadDir . $newImageName;

        // Move the uploaded file to the server
        if (move_uploaded_file($profileImage['tmp_name'], $uploadPath)) {
            // Update the profile image in the database
            $query = "UPDATE users SET profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $newImageName, $user_id);
            if ($stmt->execute()) {
                echo "<div class='overlay'></div>";
                echo "<div class='error-message'>Profile image updated successfully.";
                echo "<a href='dashboard.php'>Home</a>.</p>";
                echo "</div>";
            } else {
                echo "<div class='overlay'></div>";
                echo "<div class='error-message'>Error updating profile image.";
                echo "<a href='dashboard.php'>Home</a>.</p>";
                echo "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='overlay'></div>";
            echo "<div class='error-message'>Error uploading the file.";
            echo "<a href='dashboard.php'>Home</a>.</p>";
            echo "</div>";
        }
    } else {
        echo "<div class='overlay'></div>";
        echo "<div class='error-message'>Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        echo "<a href='dashboard.php'>Home</a>.</p>";
        echo "</div>";
    }
}

// Handle bio update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bio'])) {
    $user_id = $_SESSION['id'];
    $bio = $_POST['bio'];

    // Update bio in the database
    $query = "UPDATE users SET bio = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $bio, $user_id);
    if ($stmt->execute()) {
        echo "<div class='overlay'></div>";
        echo "<div class='error-message'>Bio updated successfully.";
        echo "<a href='dashboard.php'>Home</a>.</p>";
        echo "</div>";
    } else {
        echo "<div class='overlay'></div>";
        echo "<div class='error-message'>Error updating bio.";
        echo "<a href='dashboard.php'>Home</a>.</p>";
        echo "</div>";
    }
    $stmt->close();
}

// Fetch the current profile details from the database
$user_id = $_SESSION['id'];
$query = "SELECT username, email, birthday, class_status, height, weight, interest, profile_image, bio FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $birthday, $class_status, $height, $weight, $interests, $profileImagePath, $bio);
$stmt->fetch();
$stmt->close();

// Default image if no profile image is set
if (!$profileImagePath) {
    $profileImagePath = 'default-profile.png';
}

// Set bio to an empty string if not available
if (!$bio) {
    $bio = '';
}
// Retrieve the theme color from session
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue if no theme is set
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/profile.css ">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            <a href="../php/dashboard.php">Home</a>
            <a href="../php/settings.php">Settings</a>
            <a href="../php/history.php">History</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </header>

    <section class="form">
        <form class="upload-form" method="POST" enctype="multipart/form-data">
            <a href="dashboard.php" class="back-link"><i class="bi bi-arrow-left-circle"></i></a>
            <div class="bg">
                <label class="custom-file-upload">
                    <div class="circle" style="background-image: url('<?php echo '../uploads/' . $profileImagePath; ?>'); background-size: cover; background-position: center;">
                        <input type="file" name="profileImage" id="profileImageInput" accept="image/*" onchange="previewProfileImage(event)" />
                    </div>
                    <p>Change Profile Picture</p>
                </label>
                <button type="submit">Save Picture</button>

                <!-- User Details Section -->
                <div>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($username); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Birthday:</strong> <?php echo htmlspecialchars($birthday); ?></p>
                    <p><strong>Class Status:</strong> <?php echo htmlspecialchars($class_status); ?></p>
                    <p><strong>Height:</strong> <?php echo htmlspecialchars($height); ?> cm</p>
                    <p><strong>Weight:</strong> <?php echo htmlspecialchars($weight); ?> kg</p>
                    <p><strong>Interests:</strong> <?php echo htmlspecialchars($interests); ?></p>
                </div>

                <!-- Bio Section -->
                <div>
                    <p>Bio:</p>
                    <textarea name="bio" rows="4" cols="50"><?php echo htmlspecialchars($bio); ?></textarea>
                </div>
            </div>

        </form>
    </section>


    <script>
        // JavaScript to preview the uploaded profile image
        function previewProfileImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.circle').style.backgroundImage = `url(${e.target.result})`;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>

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