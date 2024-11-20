<?php

$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Write a Congratulation Letter</title>
    <link rel="stylesheet" href="../css/letter.css">
</head>
<body>
    <div class="container">
        <h1>How to Write a Congratulation Letter</h1>

        <!-- Introduction Section -->
        <div class="introduction">
            <p>Congratulations are always more meaningful when they come from the heart. Writing a thoughtful congratulation letter can make someone's achievement even more special. Here’s how to craft the perfect congratulation letter for any occasion.</p>
        </div>

        <!-- Step 1 -->
        <div class="step">
            <h2>Step 1: Write Your Address</h2>
            <img src="address-example.jpg" alt="Your Address Example" />
            <p>Start by writing your address at the top right corner of the page, especially if you’re mailing the letter. This lets the recipient know where the letter came from!</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <h2>Step 2: Write the Date</h2>
            <img src="date-example.jpg" alt="Date Example" />
            <p>Write the date below your address. For example, "November 20, 2024". It’s nice to include the date so the recipient remembers when you sent the letter!</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <h2>Step 3: Greeting</h2>
            <img src="greeting-example.jpg" alt="Greeting Example" />
            <p>Start your letter with a warm greeting like "Dear [Recipient's Name],". Make sure to use their name or a personal term that makes the letter feel special.</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <h2>Step 4: Express Your Congratulations</h2>
            <img src="body-example.jpg" alt="Body of the Letter Example" />
            <p>In the body of the letter, express your congratulations. Be specific about what the person has achieved. For example, "Congratulations on your graduation! I’m so proud of all the hard work you put into earning your degree!"</p>
        </div>

        <!-- Step 5 -->
        <div class="step">
            <h2>Step 5: Acknowledge Their Efforts</h2>
            <img src="acknowledge-example.jpg" alt="Acknowledgment Example" />
            <p>Take the time to acknowledge the effort that went into the achievement. "You’ve worked so hard to get to this point, and I admire your dedication and perseverance."</p>
        </div>

        <!-- Step 6 -->
        <div class="step">
            <h2>Step 6: End with Best Wishes</h2>
            <img src="closing-example.jpg" alt="Closing Example" />
            <p>End the letter by wishing them continued success or happiness. For example, "I wish you all the best as you continue to grow and achieve amazing things!"</p>
        </div>

        <!-- Step 7 -->
        <div class="step">
            <h2>Step 7: Closing Your Letter</h2>
            <img src="closing-example.jpg" alt="Closing Example" />
            <p>To end the letter, use a warm closing such as "Best wishes," "Warm regards," or "With heartfelt congratulations," followed by your name. If sending a physical letter, don’t forget to sign your name!</p>
        </div>

        <!-- Back to Top Button -->
        <div class="button-container">
        <button class="back-button" onclick="window.location.href='../php/letter_making.php'">Go Back</button>
        </div>
    </div>
</body>
</html>
