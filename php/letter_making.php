<?php

// Check if the theme color is set in the session, otherwise default to a preset value (like 'blue')
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
</head>
<header id="header">
        <h2 >Please choose your age</h2>
    </header>
    <section>
    <div class="display1">
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/origami_hard.php'">
            <h1>Birthdays</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/origami_easy.php'">
            <h1>Valentines</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/origami_hard.php'">
            <h1>Mothers day</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/origami_easy.php'">
            <h1>Fathers day</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/origami_hard.php'">
            <h1>Congrats</h1>
        </div>
        <div class="display" onclick="window.location.href='http://localhost/EELS/php/origami_easy.php'">
            <h1>Good luck</h1>
        </div>
    </div>
</section>
<button class="back-button" onclick="window.location.href='dashboard.php'">Go Back</button>
    
</body>
</html>