<?php
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Write a Mother's Day Letter</title>
    <link rel="stylesheet" href="../css/letter.css">
</head>
<body>
    <div class="container">
        <h1>How to Write a Mother's Day Letter</h1>

        <!-- Introduction Section -->
        <div class="introduction">
            <p>Writing a letter for Mother's Day is a heartfelt way to express your love and appreciation. Follow these steps to craft a meaningful message that shows how much she means to you!</p>
        </div>

        <!-- Step 1 -->
        <div class="step">
            <h2>Step 1: Write Your Address</h2>
            <img src="address-example.jpg" alt="Your Address Example" />
            <p>Start by writing your address at the top right corner of the page. It’s a good practice to include your return address so your mom knows where you’re writing from if you're mailing it!</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <h2>Step 2: Write the Date</h2>
            <img src="date-example.jpg" alt="Date Example" />
            <p>Under your address, write the date. For example, "May 10, 2024". This will help your mom know when you wrote the letter, making it even more special!</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <h2>Step 3: Mother's Day Greeting</h2>
            <img src="greeting-example.jpg" alt="Greeting Example" />
            <p>Start your letter with a loving greeting. You can write "Dear Mom," "To my wonderful Mother," or "Happy Mother’s Day, Mom!" Make it personal and full of warmth!</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <h2>Step 4: The Body of Your Mother's Day Letter</h2>
            <img src="body-example.jpg" alt="Body of the Letter Example" />
            <p>Now it’s time to pour your heart out! Write about how much she means to you, express your gratitude for everything she’s done, and share a fond memory. A heartfelt Mother's Day letter can really make her day special!</p>
        </div>

        <!-- Step 5 -->
        <div class="step">
            <h2>Step 5: Closing Your Letter</h2>
            <img src="closing-example.jpg" alt="Closing Example" />
            <p>End your letter with a loving closing like "With all my love," "Your loving child," or "Forever grateful," followed by your name. If you're mailing it, don’t forget to leave room for your signature!</p>
        </div>

        <!-- Step 6 -->
        <div class="step">
            <h2>Step 6: Add Special Touches (Optional)</h2>
            <img src="decoration-example.jpg" alt="Decorating Example" />
            <p>For an extra special touch, consider adding little decorations, like hearts, flowers, or drawings that represent your relationship with your mom. These personal touches will make your letter even more meaningful!</p>
        </div>

        <!-- Back to Top Button -->
        <div class="button-container">
        <button class="back-button" onclick="window.location.href='../php/letter_making.php'">Go Back</button>
        </div>
    </div>
</body>
</html>
