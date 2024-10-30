<?php
session_start();

// Database connection
$host = 'localhost'; // Your database host
$dbname = 'video_database'; // Your new database name for videos
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Get the selected age from the URL
if (isset($_GET['age'])) {
    $_SESSION['age'] = intval($_GET['age']); // Store age in session
} else {
    header('Location: http://localhost/EELS/php/video_select.php'); // Redirect if no age selected
    exit();
}

// Fetch video data for the selected age
$query = $pdo->prepare("SELECT option_a, option_b, option_c, option_d, correct_option, video_path FROM video_age_7");
$query->execute();
$videos = $query->fetchAll(PDO::FETCH_ASSOC);

// Check if video data exists
if (empty($videos)) {
    echo "<h3>No videos found for age " . $_SESSION['age'] . ".</h3>";
    exit();
}

// Initialize video index and score
if (!isset($_SESSION['current_video_index'])) {
    $_SESSION['current_video_index'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

// Check if the quiz has ended
if (isset($_POST['end_quiz'])) {
    header('Location: videoresult.php'); // Redirect to results page
    exit();
}

// Handle submitted answer
if (isset($_POST['answer'])) {
    $selected_answer = $_POST['answer'];
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

$current_video = $videos[$current_video_index];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Quiz</title>
    <link rel="stylesheet" href="../quiz.css">
</head>
<body>
    <header>
        <h2>Video Quiz</h2>
    </header>
    <section>
        <video width="600" controls>
            <source src="<?php echo $current_video['video_path']; ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <form method="POST" action="">
            <h3>What is the correct answer?</h3>
            <button type="submit" name="answer" value="A"><?php echo $current_video['option_a']; ?></button>
            <button type="submit" name="answer" value="B"><?php echo $current_video['option_b']; ?></button>
            <button type="submit" name="answer" value="C"><?php echo $current_video['option_c']; ?></button>
            <button type="submit" name="answer" value="D"><?php echo $current_video['option_d']; ?></button>
            <button type="submit" name="end_quiz">End Quiz</button>
        </form>
    </section>
    <script>
    function loadBackgroundImage() {
        const backgroundImage = localStorage.getItem('backgroundImage');
        if (backgroundImage) {
            document.body.style.backgroundImage = `url(${backgroundImage})`;
        }
    }
    window.onload = loadBackgroundImage;
</script>
</body>
</html>
