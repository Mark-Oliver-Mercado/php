<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Age</title>
    <link rel="stylesheet" href="../css/select.css">
</head>
<body>
    <header>
        <h2>Please choose your age</h2>
    </header>
    <section>
        <div class="display1">
            <div class="display" onclick="window.location.href='lessons_quiz.php?age=7'">
                <h1>7</h1>
            </div>
            <div class="display" onclick="window.location.href='lessons_quiz.php?age=8'">
                <h1>8</h1>
            </div>
            <div class="display" onclick="window.location.href='lessons_quiz.php?age=9'">
                <h1>9</h1>
            </div>
            <div class="display" onclick="window.location.href='lessons_quiz.php?age=10'">
                <h1>10</h1>
            </div>
            <div class="display" onclick="window.location.href='lessons_quiz.php?age=11'">
                <h1>11</h1>
            </div>
            <div class="display" onclick="window.location.href='lessons_quiz.php?age=12'">
                <h1>12</h1>
            </div>
            <div class="display full" onclick="window.location.href='lessons_quiz.php?age=13'">
                <h1>13</h1>
            </div>
        </div>
        <button class="back-button" onclick="window.location.href='dashboard.php'">Go Back</button>
    </section>
    <script>
    </script>
</body>
</html>
