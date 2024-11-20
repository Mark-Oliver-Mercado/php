<?php
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Write a Birthday Letter</title>
    <link rel="stylesheet" href="../css/letter.css">
</head>
<body>
    <div class="container">
        <h1>How to Write a Birthday Letter</h1>

        <!-- Introduction Section -->
        <div class="introduction">
            <p>Writing a birthday letter is a wonderful way to celebrate someone special. Follow these easy steps to craft a heartfelt birthday message that will make them smile!</p>
            <p>If having diffuculty as for parental supervision</p>
        </div>

        <!-- Step 1 -->
        <div class="step">
            <h2>Step 1: Write Your Address</h2>
            <img src="address-example.jpg" alt="Your Address Example" />
            <p>Start by writing your address at the top right corner of the page. This is where your friend or family member will know to send a reply or thank you note!</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <h2>Step 2: Write the Date</h2>
            <img src="date-example.jpg" alt="Date Example" />
            <p>Under your address, write the date. For example, "November 20, 2024". It helps the birthday recipient know when the message was written!</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <h2>Step 3: Birthday Greeting</h2>
            <img src="greeting-example.jpg" alt="Greeting Example" />
            <p>Start your birthday letter with a cheerful greeting. You can write "Dear [Name], Happy Birthday!" or "Hi [Name], Wishing you the happiest birthday!" Make it festive and warm!</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <h2>Step 4: The Body of Your Birthday Letter</h2>
            <img src="body-example.jpg" alt="Body of the Letter Example" />
            <p>Now, it’s time to write your message! You can talk about shared memories, wish them a wonderful year ahead, or share a funny anecdote. A birthday letter should be thoughtful and personal!</p>
        </div>

        <!-- Step 5 -->
        <div class="step">
            <h2>Step 5: Birthday Closing</h2>
            <img src="closing-example.jpg" alt="Closing Example" />
            <p>To end your letter, use a closing that shows your love and best wishes. You can write "With love," "Warm wishes," or "Best birthday wishes," followed by your name. If you are sending it by mail, leave space for your signature!</p>
        </div>

        <!-- Step 6 -->
        <div class="step">
            <h2>Step 6: Add Decorations (Optional)</h2>
            <img src="decoration-example.jpg" alt="Decorating Example" />
            <p>For extra fun, add colorful decorations, balloons, or drawings to your birthday letter. This extra touch makes it more personal and festive!</p>
        </div>

        <!-- Back to Top Button -->
        <div class="button-container">
            <button class="back-button" onclick="window.location.href='../php/letter_making.php'">Go Back</button>
        </div>
    </div>
</body>
</html>
