<?php
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Write a Father's Day Letter</title>
    <link rel="stylesheet" href="../css/letter.css">
</head>
<body>
    <div class="container">
        <h1>How to Write a Father's Day Letter</h1>

        <!-- Introduction Section -->
        <div class="introduction">
            <p>Writing a letter for Father's Day is a wonderful way to express your love and gratitude to your dad. Follow these steps to create a meaningful letter that will show him just how much he means to you!</p>
        </div>

        <!-- Step 1 -->
        <div class="step">
            <h2>Step 1: Write Your Address</h2>
            <img src="address-example.jpg" alt="Your Address Example" />
            <p>Start by writing your address at the top right corner of the page. This will make it easier for your dad to know where the letter came from if you’re mailing it!</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <h2>Step 2: Write the Date</h2>
            <img src="date-example.jpg" alt="Date Example" />
            <p>Under your address, write the date. For example, "June 16, 2024". This will let your dad know exactly when the letter was written.</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <h2>Step 3: Father's Day Greeting</h2>
            <img src="greeting-example.jpg" alt="Greeting Example" />
            <p>Begin your letter with a heartfelt greeting. You can write "Dear Dad," "To my amazing Father," or "Happy Father’s Day, Dad!" Choose a greeting that feels most special to you and your relationship.</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <h2>Step 4: The Body of Your Father's Day Letter</h2>
            <img src="body-example.jpg" alt="Body of the Letter Example" />
            <p>Now it’s time to write about what your dad means to you. Share your appreciation for all his support, sacrifices, and love. Mention a special memory or tell him how he has shaped your life. A personal message will make the letter even more meaningful.</p>
        </div>

        <!-- Step 5 -->
        <div class="step">
            <h2>Step 5: Closing Your Letter</h2>
            <img src="closing-example.jpg" alt="Closing Example" />
            <p>End your letter with a loving closing, such as "With all my love," "Your loving child," or "Forever grateful," followed by your name. If you're mailing it, leave room for your signature!</p>
        </div>

        <!-- Step 6 -->
        <div class="step">
            <h2>Step 6: Add Special Touches (Optional)</h2>
            <img src="decoration-example.jpg" alt="Decorating Example" />
            <p>To make the letter even more special, you can include drawings, fun doodles, or personal mementos that remind your dad of happy times together. These small touches can make the letter unforgettable!</p>
        </div>

        <!-- Back to Top Button -->
        <div class="button-container">
        <button class="back-button" onclick="window.location.href='../php/letter_making.php'">Go Back</button>
        </div>
    </div>
</body>
</html>
