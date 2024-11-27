<?php
session_start(); // Start the session

include '../php/config.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['id'];
$query = "SELECT username, email, theme_color, height, weight, class_status, interest FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $theme_color, $height, $weight, $class_status, $interest);
$stmt->fetch();
$stmt->close();

// Update email logic
if (isset($_POST['update_email'])) {
    $newEmail = $_POST['email'];
    if ($newEmail !== $email) {
        $query = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $newEmail, $user_id);
        if ($stmt->execute()) {
            $email = $newEmail;
            echo "<div class='overlay'></div><div class='success-message'>Email updated successfully.<a href='settings.php'>Ok</a></div>";
        } else {
            echo "<div class='overlay'></div><div class='error-message'>Error updating email.<a href='settings.php'>Ok</a></div>";
        }
        $stmt->close();
    } else {
        echo "<div class='overlay'></div><div class='error-message'>New email is the same as the current email.<a href='settings.php'>Ok</a></div>";
    }
}

// Update profile info logic (name, height, weight, status, interest)
if (isset($_POST['update_profile'])) {
    $newUsername = $_POST['username'];
    $newHeight = $_POST['height'];
    $newWeight = $_POST['weight'];
    $newClassStatus = $_POST['class_status'];
    $newInterest = $_POST['interest'];

    // Update profile info in the database
    $query = "UPDATE users SET username = ?, height = ?, weight = ?, class_status = ?, interest = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $newUsername, $newHeight, $newWeight, $newClassStatus, $newInterest, $user_id);
    if ($stmt->execute()) {
        $username = $newUsername;
        $height = $newHeight;
        $weight = $newWeight;
        $class_status = $newClassStatus;
        $interest = $newInterest;
        echo "<div class='overlay'></div><div class='success-message'>Profile updated successfully.<a href='settings.php'>Ok</a></div>";
    } else {
        echo "<div class='overlay'></div><div class='error-message'>Error updating profile.<a href='settings.php'>Ok</a></div>";
    }
    $stmt->close();
}

// Handle theme update
if (isset($_POST['update_theme'])) {
    $themeColor = $_POST['theme_color'];
    if (!empty($themeColor)) {
        $query = "UPDATE users SET theme_color = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $themeColor, $user_id);
        if ($stmt->execute()) {
            // Save the theme in the session for immediate use
            $_SESSION['theme_color'] = $themeColor;
            // Redirect back to refresh the page
            header("Location: settings.php");
            exit();
        } else {
            echo "<div class='overlay'></div><div class='error-message'>Error updating theme.<a href='settings.php'>Ok</a></div>";
        }
        $stmt->close();
    } else {
        echo "<div class='overlay'></div><div class='error-message'>Please select a theme color.<a href='settings.php'>Ok</a></div>";
    }
}

// Check for the theme stored in the session or database
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : $theme_color;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../css/settings.css">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <header>
        <h2>Welcome to Your Dashboard, <?php echo $_SESSION['username']; ?>!</h2>
        <!-- Add the dynamic background image directly to the logout button -->
        <a href="javascript:void(0)" class="logout" onclick="toggleDropdown()" style="background-image: url('<?php echo $profileImagePath; ?>');"></a>

        <div class="logo d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="../images/logo eels.png" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
            </a>
        </div>

        <div id="dropdown" class="dropdown-content">
            <a href="../php/profile.php">Profile</a>
            <a href="../php/history.php">History</a>
            <a href="../php/logout.php">Logout</a>
        </div>
    </header>

    <div class="container">
        <h2>Account Settings</h2>
        <a href="dashboard.php" class="back-link"><i class="bi bi-arrow-left-circle"></a></i>
        <!-- Update Email Form -->
        <form method="POST" class="form-section">
            <h3>Update Email</h3>
            <label for="email">Current Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <button type="submit" name="update_email">Update Email</button>
        </form>

        <!-- Update Profile Info Form -->
        <form method="POST" class="form-section">
            <h3>Update Profile Information</h3>
            <label for="username">Name:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            <label for="height">Height (in cm):</label>
            <input type="number" name="height" value="<?php echo htmlspecialchars($height); ?>" required>
            <label for="weight">Weight (in kg):</label>
            <input type="number" name="weight" value="<?php echo htmlspecialchars($weight); ?>" required>
            <label for="class_status">Class Status:</label>
            <input type="text" name="class_status" value="<?php echo htmlspecialchars($class_status); ?>" required>
            <label for="interest">Interests:</label>
            <input type="text" name="interest" value="<?php echo htmlspecialchars($interest); ?>" required>
            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <!-- Theme Selection Form -->
        <form method="POST" class="form-section">
            <h3>Choose Theme Color</h3>
            <label for="theme_color">Select Theme:</label>
            <select name="theme_color">
                <option value="blue" <?php echo ($theme_color == 'blue') ? 'selected' : ''; ?>>Blue</option>
                <option value="pink" <?php echo ($theme_color == 'pink') ? 'selected' : ''; ?>>Pink</option>
            </select>
            <button type="submit" name="update_theme">Save Theme</button>
        </form>

        <!-- Delete Account Form -->
        <form method="POST" class="form-section">
            <h3>Delete Account</h3>
            <p>This action cannot be undone. Are you sure you want to delete your account?</p>
            <button type="submit" name="delete_account" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
        </form>


    </div>

</body>

</html>