<?php
session_start(); // Start the session
include 'config.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store the user's information in the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id']; // Store user ID in session
            $_SESSION['loggedin'] = true; // Set logged-in session variable

            // Fetch the theme color from the database and store it in the session
            $_SESSION['theme_color'] = $user['theme_color']; // Assuming the theme color is stored in the 'theme_color' column

            // Redirect to the dashboard page
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password message with custom styling
            echo "<div class='overlay'></div>";
            echo "<div class='error-message'>";
            echo "<h1>Oops! Invalid password.</h1>";
            echo "<p>Please double-check your password and <a href='login.php'>try again</a>.</p>";
            echo "</div>";
        }
    } else {
        // No user found message with custom styling
        echo "<div class='overlay'></div>";
        echo "<div class='error-message'>";
        echo "<h1>No account found with this email</h1>";
        echo "<p>If you don’t have an account, please <a href='signup.php'>sign up here</a>.</p>";
        echo "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../signin.css"> <!-- Ensure the correct path -->
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" required value="" autocomplete="on">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <div class="show-password-container">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Show Password</label>
            </div>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const checkbox = document.getElementById("showPassword");
            passwordField.type = checkbox.checked ? "text" : "password";
        }
    </script>
</body>

</html>