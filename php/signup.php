<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="../signin.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form id="signupForm" action="signup.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required onkeyup="validatePassword()">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required onkeyup="validatePassword()">
            <div id="passwordError" style="color: red;"></div> <!-- Error message area -->
            <button type="submit" id="submitButton" disabled>Sign Up</button>
        </form>
        <p>Already have an account? <a href="http://localhost/EELS/php/login.php">Login here</a></p>
    </div>
    <script>
        function validatePassword() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            const submitButton = document.getElementById("submitButton");
            const passwordError = document.getElementById("passwordError");

            if (password === confirmPassword) {
                submitButton.disabled = false; // Enable the submit button
                passwordError.textContent = ""; // Clear any error message
            } else {
                submitButton.disabled = true; // Disable the submit button
                passwordError.textContent = "Passwords do not match."; // Show error message
            }
        }
    </script>
</body>
</html>
<?php
include 'config.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email is already registered
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='overlay'></div>"; // Overlay background
        echo "<div class='error-message'>";
        echo "<h1>Email already exists</h1>";
        echo "<p>Please <a href='http://localhost/EELS/php/signup.php'>try again</a>.</p>";
        echo "</div>";
    } else {
        // Insert user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        if ($stmt->execute()) {
            echo "<div class='overlay'></div>"; // Overlay background
            echo "<div class='success-message'>";
            echo "<h1>Signup successful!</h1>";
            echo "<p><a href='http://localhost/EELS/php/login.php'>Login here</a></p>";
            echo "</div>";
        } else {
            echo "<div class='overlay'></div>";
            echo "<div class='error-message'>";
            echo "<h1>Error</h1>";
            echo "<p>" . $stmt->error . "</p>";
            echo "</div>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>