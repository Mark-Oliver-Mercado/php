<?php
session_start();

// Check if the user is logged in and if email is set in the session
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ensure the quiz has been taken
if (!isset($_SESSION['answers']) || !isset($_SESSION['age']) || !isset($_SESSION['lesson'])) {
    header('Location: card_select.php'); // Redirect if no answers or age/lesson are present
    exit();
}

// Get logged-in user's email from session
$username = $_SESSION['username'];

// Database connection for retrieving correct answers
$host = 'localhost'; // Your database host
$dbname = 'card_database'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

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
$table_name = "card_age_" . $age . "_lesson_" . $lesson; // Adjusted to match your table name
$query = $pdo->prepare("SELECT correct_option FROM " . $table_name);
$query->execute();
$correct_answers = $query->fetchAll(PDO::FETCH_COLUMN);

// Calculate the score and results
$score = 0;
$results = []; // Array to hold question results

// Count how many answers were provided
$answered_count = count($_SESSION['answers']); // Number of answered questions

// Ensure we only consider the number of correct answers up to the number of answers submitted
$correct_answers = array_slice($correct_answers, 0, $answered_count); // Only keep the correct answers that were asked

foreach ($_SESSION['answers'] as $index => $answer) {
    $is_correct = strtoupper($answer) === strtoupper($correct_answers[$index]); // Compare in uppercase
    if ($is_correct) {
        $score++;
    }
    $results[] = [
        'question_index' => $index + 1, // Assuming questions are 1-indexed for display
        'user_answer' => $answer,
        'correct_answer' => isset($correct_answers[$index]) ? $correct_answers[$index] : null,
        'is_correct' => $is_correct,
    ];
}

// Clear session variables for a new quiz
unset($_SESSION['answers'], $_SESSION['age'], $_SESSION['lesson'], $_SESSION['current_question_index'], $_SESSION['score']);

// Database connection for saving results to user_database
$user_dbname = 'user_database'; // The database where you want to store results
try {
    $pdo_user = new PDO("mysql:host=$host;dbname=$user_dbname;charset=utf8", $username, $password);
    $pdo_user->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection for saving results failed: " . $e->getMessage());
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
        <h3>Your Score: <?php echo $score; ?> out of <?php echo $answered_count; ?></h3>
        <button onclick="window.location.href='http://localhost/EELS/php/lessons_card.php?age=<?php echo $age; ?>'" class="quiz-button"> Next Lesson </button>
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
                        <td><?php echo isset($result['correct_answer']) ? htmlspecialchars($result['correct_answer']) : 'N/A'; ?></td>
                        <td><?php echo $result['is_correct'] ? 'Correct' : 'Wrong'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>

</html>