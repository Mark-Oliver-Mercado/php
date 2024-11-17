<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'video_database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Ensure age and lesson are set
$age = $_SESSION['age'] ?? null;
$lesson = $_GET['lesson'] ?? null; // Get lesson from URL

if (!isset($age) || !isset($lesson)) {
    header('Location: select_age.php'); // Redirect if age or lesson is not set
    exit();
}

// Store the lesson in the session
$_SESSION['lesson'] = intval($lesson);

// Fetch video data based on age and lesson
$query = $pdo->prepare("SELECT id, option_a, option_b, option_c, option_d, correct_option, video_path 
                        FROM video_age_" . $age . "_lesson_" . $lesson);
$query->execute();
$videos = $query->fetchAll(PDO::FETCH_ASSOC);

// Check if video data exists
if (empty($videos)) {
    echo "<h3>No videos found for age " . htmlspecialchars($age) . " and lesson " . htmlspecialchars($lesson) . ".</h3>";
    exit();
}

// Initialize video index and score if this is the first video
if (!isset($_SESSION['current_video_index'])) {
    $_SESSION['current_video_index'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

// Check if the quiz has ended
if (isset($_POST['end_quiz'])) {
    // Fill unanswered questions with null
    while (count($_SESSION['answers']) < count($videos)) {
        $_SESSION['answers'][] = null;
    }
    header('Location: videoresult.php'); // Redirect to results page
    exit();
}

// Handle submitted answer
if (isset($_POST['answer'])) {
    $selected_answer = $_POST['answer'];
    // Store the answer in session
    $_SESSION['answers'][$_SESSION['current_video_index']] = $selected_answer;

    // Check if the answer is correct
    if ($selected_answer === $videos[$_SESSION['current_video_index']]['correct_option']) {
        $_SESSION['score']++;
    }

    // Move to the next video
    $_SESSION['current_video_index']++;
}

// Get the current video
$current_video_index = $_SESSION['current_video_index'];
if ($current_video_index >= count($videos)) {
    header('Location: videoresult.php'); // Redirect to results page if finished
    exit();
}

// Current video details
$current_video = $videos[$current_video_index];
$video_url = $current_video['video_path'];
$embed_url = str_replace('watch?v=', 'embed/', $video_url);
?>
<?php

// Check if the theme color is set in the session, otherwise default to a preset value (like 'blue')
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Quiz for Age <?php echo htmlspecialchars($age); ?> - Lesson <?php echo htmlspecialchars($lesson); ?></title>
    <link rel="stylesheet" href="../quiz.css">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
    
</head>
<body>
    <header>
        <h2>Video Quiz for Age <?php echo htmlspecialchars($age); ?> - Lesson <?php echo htmlspecialchars($lesson); ?></h2>
    </header>
    <section>
        <!-- Embed YouTube Video -->
        <iframe width="600" height="350" src="<?php echo htmlspecialchars($embed_url); ?>" frameborder="0" allowfullscreen></iframe>
        
        <form method="POST" action="">
            <h3>What is the correct answer?</h3>
            <button type="submit" name="answer" value="A"><?php echo htmlspecialchars($current_video['option_a']); ?></button>
            <button type="submit" name="answer" value="B"><?php echo htmlspecialchars($current_video['option_b']); ?></button>
            <button type="submit" name="answer" value="C"><?php echo htmlspecialchars($current_video['option_c']); ?></button>
            <button type="submit" name="answer" value="D"><?php echo htmlspecialchars($current_video['option_d']); ?></button>
            <button type="submit" name="end_quiz">End Quiz</button>
        </form>
    </section>
    <script>
    </script>
</body>
</html>
