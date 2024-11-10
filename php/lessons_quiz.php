<?php
session_start();

// Check if age is provided in the URL
if (isset($_GET['age'])) {
    $_SESSION['age'] = intval($_GET['age']);
} else {
    header('Location: select_age.php'); // Redirect if age is missing
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Lesson for Age <?php echo $_SESSION['age']; ?></title>
    <link rel="stylesheet" href="../css/select.css">
</head>
<body>
    <header>
        <h2>Please choose a lesson for Age <?php echo $_SESSION['age']; ?></h2>
    </header>
    <section>
        <div class="display1">
            <div class="display" onclick="window.location.href='quiz.php?age=<?php echo $_SESSION['age']; ?>&lesson=1'">
                <h1>Lesson 1</h1>
            </div>
            <div class="display" onclick="window.location.href='quiz.php?age=<?php echo $_SESSION['age']; ?>&lesson=2'">
                <h1>Lesson 2</h1>
            </div>
            <div class="display" onclick="window.location.href='quiz.php?age=<?php echo $_SESSION['age']; ?>&lesson=3'">
                <h1>Lesson 3</h1>
            </div>
            <!-- Add more lessons as needed -->
        </div>
        <button class="back-button" onclick="window.location.href='select_age.php'">Go Back</button>
    </section>
    <script>
    </script>
</body>
</html>
