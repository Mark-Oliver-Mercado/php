<?php
session_start();

// Ensure the quiz has been taken and session data is set
if (!isset($_SESSION['answers']) || !isset($_SESSION['age']) || !isset($_SESSION['lesson'])) {
    header('Location: video_select.php'); // Redirect if no answers or age/lesson are present
    exit();
}

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

// Retrieve age and lesson from the session
$age = $_SESSION['age'];
$lesson = $_SESSION['lesson'];

// Database query to fetch correct answers for the specific age and lesson
$query = $pdo->prepare("SELECT correct_option FROM video_age_" . $age . "_lesson_" . $lesson);
$query->execute();
$correct_answers = $query->fetchAll(PDO::FETCH_COLUMN);

// Calculate the score and results for answered questions only
$score = 0;
$results = []; // Array to hold answered question results

foreach ($_SESSION['answers'] as $index => $answer) {
    if (!empty($answer)) { // Check if the question was answered
        $correct_answer = $correct_answers[$index] ?? null;
        $is_correct = $answer === $correct_answer;
        if ($is_correct) {
            $score++;
        }
        $results[] = [
            'question_index' => $index + 1, // Assuming questions are 1-indexed for display
            'user_answer' => $answer,
            'correct_answer' => $correct_answer ?? 'N/A',
            'is_correct' => $is_correct,
        ];
    }
}

// Clear session variables for a new quiz
unset($_SESSION['answers'], $_SESSION['age'], $_SESSION['lesson'], $_SESSION['current_video_index'], $_SESSION['score']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Quiz Results</title>
    <link rel="stylesheet" href="../quiz.css">
</head>
<body>
    <header class="quiz-header">
        <h2>Video Quiz Results</h2>
    </header>
    <section class="quiz-score">
        <h3>Your Score: <?php echo $score; ?> out of <?php echo count($results); ?></h3>
        <button onclick="window.location.href='http://localhost/EELS/php/video_select.php'" class="quiz-button">Take Another Quiz</button>
    </section>
    <section class="quiz-results">
        <h3>Your Answers</h3>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Question #</th>
                    <th>Your Answer</th>
                    <th>Correct Answer</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr class="<?php echo $result['is_correct'] ? 'correct' : 'wrong'; ?>">
                        <td><?php echo htmlspecialchars($result['question_index']); ?></td>
                        <td><?php echo htmlspecialchars($result['user_answer']); ?></td>
                        <td><?php echo htmlspecialchars($result['correct_answer']); ?></td>
                        <td><?php echo $result['is_correct'] ? 'Correct' : 'Wrong'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <script>
    </script>
</body>
</html>
