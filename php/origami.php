<?php
session_start(); // Start the session

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
<body>
<header id="header">
        <h2 >Please choose your age</h2>
    </header>
    <section>
    <div class="display1">
    <div class="display" onclick="window.location.href='../origami/origami_papercrane.php'">
            <h1>Paper Crane</h1>
        </div>
        <div class="display" onclick="window.location.href='../origami/origami_frog.php'">
            <h1>Paper Frog</h1>
        </div>
        <div class="display" onclick="window.location.href='../origami/origami_flower.php'">
            <h1>Origami Lutos Flower</h1>
        </div>
        <div class="display" onclick="window.location.href='../origami/origami_paperboat.php'">
            <h1>Paper Boat</h1>
        </div>
        <div class="display" onclick="window.location.href='../origami/origami_butterfly.php'">
            <h1>Origami ButterFly</h1>
        </div>
        <div class="display" onclick="window.location.href='../origami/origami_dragon.php'">
            <h1>Origami Dragon</h1>
        </div>
    </div>
</section>
<button class="back-button" onclick="window.location.href='dashboard.php'">Go Back</button>
    
</body>
</html>
