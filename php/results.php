<?php
session_start();

// Mark the quiz as completed
$_SESSION['quiz_completed'] = true;

// Ensure the quiz has been taken
if (!isset($_SESSION['answers']) || !isset($_SESSION['age']) || !isset($_SESSION['lesson'])) {
    header('Location: select_age.php'); // Redirect if no answers or age/lesson are present
    exit();
}

// Retrieve age and lesson from the session
$age = $_SESSION['age'];
$lesson = $_SESSION['lesson'];

// Database connection for the quiz database
$host = 'localhost';
$dbname_quiz = 'data_database';
$username = 'root';
$password = '';

try {
    $pdo_quiz = new PDO("mysql:host=$host;dbname=$dbname_quiz;charset=utf8", $username, $password);
    $pdo_quiz->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch correct answers for the specific age and lesson
$query = $pdo_quiz->prepare("SELECT correct_option FROM quiz_age_" . $age . "_lesson_" . $lesson);
$query->execute();
$correct_answers = $query->fetchAll(PDO::FETCH_COLUMN);

// Calculate the score
$score = 0;
$results = [];

foreach ($_SESSION['answers'] as $index => $answer) {
    if (!empty($answer)) {
        $correct_answer = $correct_answers[$index] ?? null;
        $is_correct = $answer === $correct_answer;
        if ($is_correct) {
            $score++;
        }
        $results[] = [
            'question_index' => $index + 1,
            'user_answer' => $answer,
            'correct_answer' => $correct_answer ?? 'N/A',
            'is_correct' => $is_correct,
        ];
    }
}

// Clear session variables for a new quiz
unset($_SESSION['answers'], $_SESSION['age'], $_SESSION['lesson'], $_SESSION['current_question_index'], $_SESSION['score']);

// Save quiz results to the user database
$dbname_user = 'user_database';

try {
    $pdo_user = new PDO("mysql:host=$host;dbname=$dbname_user;charset=utf8", $username, $password);
    $pdo_user->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Insert the quiz results into the scorelist table
$current_date = date("Y-m-d H:i:s");

try {
    $insertQuery = $pdo_user->prepare("
        INSERT INTO scorelist (username, lesson, date, score) 
        VALUES (:username, :lesson, :date, :score)
    ");
    $insertQuery->execute([
        ':username' => $_SESSION['username'], // Get username from the session
        ':lesson' => $lesson,
        ':date' => $current_date,
        ':score' => $score,
    ]);
} catch (PDOException $e) {
    die("Failed to save quiz results to the user database: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="../quiz.css">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
</head>

<body>
    <header class="quiz-header">
        <h2>Quiz Results</h2>
    </header>
    <section class="quiz-score">
        <h3>Your Score: <?php echo $score; ?> / <?php echo count($results); ?></h3>
        <button onclick="window.location.href='http://localhost/EELS/php/lessons_quiz.php?age=7'" class="quiz-button"> Next Lesson </button>
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
</body>

</html>