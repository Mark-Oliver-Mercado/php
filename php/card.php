<?php
session_start();

// Database connection
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

// Ensure age and lesson are set
$age = $_SESSION['age'] ?? null;
$lesson = $_GET['lesson'] ?? null; // Get lesson from URL

if (!isset($age) || !isset($lesson)) {
    header('Location: card_select.php'); // Redirect if age or lesson is not set
    exit();
}

// Store the lesson in the session
$_SESSION['lesson'] = intval($lesson);

// Fetch quiz questions based on age and lesson
$query = $pdo->prepare("SELECT id, question_text, option_a, option_b, option_c, option_d, correct_option 
                        FROM card_age_" . $age . "_lesson_" . $lesson);
$query->execute();
$questions = $query->fetchAll(PDO::FETCH_ASSOC);

// Check if quiz data exists
if (empty($questions)) {
    echo "<h3>No quiz found for age " . htmlspecialchars($age) . " and lesson " . htmlspecialchars($lesson) . ".</h3>";
    exit();
}

// Initialize question index and score if this is the first question
if (!isset($_SESSION['current_question_index'])) {
    $_SESSION['current_question_index'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

// Check if the quiz has ended
if (isset($_POST['end_quiz'])) {
    header('Location: cardresult.php'); // Redirect to results page
    exit();
}

// Handle submitted answer
if (isset($_POST['answer'])) {
    $selected_answer = strtoupper(trim($_POST['answer'])); // Convert to uppercase for comparison
    // Store the answer in session
    $_SESSION['answers'][$_SESSION['current_question_index']] = $selected_answer;

    // Check if the answer is correct
    if (isset($questions[$_SESSION['current_question_index']]['correct_option'])) {
        if ($selected_answer === strtoupper($questions[$_SESSION['current_question_index']]['correct_option'])) {
            $_SESSION['score']++;
        }
    }

    // Move to the next question
    $_SESSION['current_question_index']++;
}

// Get the current question
$current_question_index = $_SESSION['current_question_index'];
if ($current_question_index >= count($questions)) {
    header('Location: cardresult.php'); // Redirect to results page if finished
    exit();
}

// Current question details
$current_question = $questions[$current_question_index];
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
    <title>Identification for Age <?php echo htmlspecialchars($age); ?> - Lesson <?php echo htmlspecialchars($lesson); ?></title>
    <link rel="stylesheet" href="../quiz.css">
    <link rel="stylesheet" href="../css/<?php echo ($theme_color == 'blue') ? 'blue' : 'pink'; ?>.css">
</head>

<body>
    <header>
        <h2>Identification for Age <?php echo htmlspecialchars($age); ?> - Lesson <?php echo htmlspecialchars($lesson); ?></h2>
    </header>
    <section>
        <h3><?php echo htmlspecialchars($current_question['question_text']); ?></h3>
        <form method="POST" action="" autocomplete="off">
            <!-- Disable autofill for this input field -->
            <input type="text" name="answer" placeholder="Type your answer..... )" value="" autocomplete="off">
            <button type="submit" name="submit_answer">Submit Answer</button>
            <button type="submit" name="end_quiz">End Quiz</button>
        </form>
    </section>
    <script>
        // JavaScript can be added here if necessary
    </script>
</body>

</html>