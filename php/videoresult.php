<?php
session_start();

// Ensure the quiz has been taken
if (!isset($_SESSION['answers'])) {
    header('Location: video_select.php'); // Redirect to age selection if no answers are present
    exit();
}

// Database connection
$host = 'localhost'; // Your database host
$dbname = 'video_database'; // Your database name for videos
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch correct answers
$query = $pdo->prepare("SELECT correct_option FROM video_age_7");
$query->execute();
$correct_answers = $query->fetchAll(PDO::FETCH_COLUMN);

// Calculate the score and results
$score = 0;
$results = []; // Array to hold question results

// Count how many answers were provided
$answered_count = count($_SESSION['answers']); // Number of answered questions

foreach ($_SESSION['answers'] as $index => $answer) {
    $is_correct = $answer === $correct_answers[$index];
    if ($is_correct) {
        $score++;
    }
    $results[] = [
        'question_index' => $index + 1, // Assuming questions are 1-indexed for display
        'user_answer' => $answer,
        'correct_answer' => $correct_answers[$index],
        'is_correct' => $is_correct,
    ];
}

// Clear session variables for a new quiz
unset($_SESSION['answers']);
unset($_SESSION['age']); // Reset age if needed
unset($_SESSION['current_video_index']); // Also clear current video index if it's being used
unset($_SESSION['score']); // Clear score if it's being used
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="../quiz.css">
</head>
<body>
    <header class="quiz-header">
        <h2>Video Quiz Results</h2>
    </header>
    <section class="quiz-score">
        <h3>Your Score: <?php echo $score; ?> out of <?php echo $answered_count; ?></h3> <!-- Use the answered count here -->
        <button onclick="window.location.href='http://localhost/EELS/php/video_select.php'" class="quiz-button">Take Another Quiz</button>
    </section>
    <section class="quiz-results">
        <h3>Your Answers</h3>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Question #</th>
                    <th>Your Answer</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr class="<?php echo $result['is_correct'] ? 'correct' : 'wrong'; ?>">
                        <td><?php echo htmlspecialchars($result['question_index']); ?></td>
                        <td><?php echo htmlspecialchars($result['user_answer']); ?></td>
                        <td><?php echo $result['is_correct'] ? 'Correct' : 'Wrong'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
