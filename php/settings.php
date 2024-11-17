<?php
session_start();
include '../php/config.php'; // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['id'];
$query = "SELECT username, email, theme_color FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $theme_color);
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
            echo "<div class='overlay'></div><div class='success-message'>Email updated successfully.<a href='settings.php'>Ok</a></p></div>";
        } else {
            echo "<div class='overlay'></div><div class='error-message'>Error updating email.<a href='settings.php'>Ok</a></p></div>";
        }
        $stmt->close();
    } else {
        echo "<div class='overlay'></div><div class='error-message'>New email is the same as the current email.<a href='settings.php'>Ok</a></p></div>";
    }
}

// Change password logic
if (isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($currentPassword, $hashedPassword)) {
        if ($newPassword === $confirmPassword) {
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $newHashedPassword, $user_id);
            if ($stmt->execute()) {
                echo "<div class='overlay'></div><div class='success-message'>Password changed successfully.<a href='settings.php'>Ok</a></p></div>";
            } else {
                echo "<div class='overlay'></div><div class='error-message'>Error updating password.<a href='settings.php'>Ok</a></p></div>";
            }
            $stmt->close();
        } else {
            echo "<div class='overlay'></div><div class='error-message'>New passwords do not match.<a href='settings.php'>Ok</a></p></div>";
        }
    } else {
        echo "<div class='overlay'></div><div class='error-message'>Current password is incorrect.<a href='settings.php'>Ok</a></p></div>";
    }
}

// Delete account logic
if (isset($_POST['delete_account'])) {
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "<div class='overlay'></div><div class='error-message'>Error deleting account.<a href='settings.php'>Ok</a></p></div>";
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
            echo "<div class='overlay'></div><div class='error-message'>Error updating theme.<a href='settings.php'>Ok</a></p></div>";
        }
        $stmt->close();
    } else {
        echo "<div class='overlay'></div><div class='error-message'>Please select a theme color.<a href='settings.php'>Ok</a></p></div>";
    }
}

// Check for the theme stored in the session
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
</head>
<body>
    <div class="container">
        <h2>Account Settings</h2>

        <!-- Update Email Form -->
        <form method="POST" class="form-section">
            <h3>Update Email</h3>
            <label for="email">Current Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <button type="submit" name="update_email">Update Email</button>
        </form>

        <!-- Change Password Form -->
        <form method="POST" class="form-section">
            <h3>Change Password</h3>
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" required>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" required>
            <button type="submit" name="change_password">Change Password</button>
        </form>

        <!-- Delete Account Form -->
        <form method="POST" class="form-section">
            <h3>Delete Account</h3>
            <p>This action cannot be undone. Are you sure you want to delete your account?</p>
            <button type="submit" name="delete_account" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
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

        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>
</body>
</html>
