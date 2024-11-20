<?php
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Origami Video Tutorial</title>
    <link rel="stylesheet" href="../css/origami.css">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
</head>
<body>
    <div class="container">
        <h1>Origami Crane Video Tutorial</h1>
        
        <!-- Video Tutorial -->
        <div class="video-container">
    <iframe 
        src="https://www.youtube.com/embed/khuVGbCE0PY"  
        title="Origami Tutorial"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe>
</div>

        <!-- Instructions -->
        <div class="instructions">
            <p>Follow the video tutorial above to create your own origami crane. Make sure to pause and rewind the video as needed.</p>
            <ul>
                <li>Start with a square sheet of paper.</li>
                <li>Follow the folds as shown in the video.</li>
                <li>Take your time to get each fold precise.</li>
                <li>Don't hesitate to replay sections if you miss a step.</li>
            </ul>
        </div>

        <div class="button-container">
        <button class="back-button" onclick="window.location.href='../php/origami.php'">Go Back</button>
        </div>
    </div>
</body>
</html>