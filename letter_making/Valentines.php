<?php
$theme_color = isset($_SESSION['theme_color']) ? $_SESSION['theme_color'] : 'blue'; // Default to blue theme if not set

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Write a Valentine's Day Letter</title>
    <link rel="stylesheet" href="../css/letter.css">
</head>
<body>
    <div class="container">
        <h1>How to Write a Valentine's Day Letter</h1>

        <!-- Introduction Section -->
        <div class="introduction">
            <p>Valentine's Day is the perfect occasion to express your love and appreciation for someone special. Writing a heartfelt letter can make this day even more memorable. Follow these steps to create the perfect Valentine's Day letter for your loved one!</p>
        </div>

        <!-- Step 1 -->
        <div class="step">
            <h2>Step 1: Write Your Address</h2>
            <img src="address-example.jpg" alt="Your Address Example" />
            <p>Start by writing your address at the top right corner of the page, especially if you're mailing it. This lets the recipient know where the letter came from!</p>
        </div>

        <!-- Step 2 -->
        <div class="step">
            <h2>Step 2: Write the Date</h2>
            <img src="date-example.jpg" alt="Date Example" />
            <p>Under your address, write the date. For example, "February 14, 2024". This will show your loved one exactly when you wrote the letter and adds a romantic touch to the moment!</p>
        </div>

        <!-- Step 3 -->
        <div class="step">
            <h2>Step 3: Valentine's Day Greeting</h2>
            <img src="greeting-example.jpg" alt="Greeting Example" />
            <p>Start your letter with a sweet greeting like "Dear [Loved One's Name]," or "My dearest [Name],". You can also use something romantic like "To the love of my life," to make it extra special.</p>
        </div>

        <!-- Step 4 -->
        <div class="step">
            <h2>Step 4: The Body of Your Valentine's Letter</h2>
            <img src="body-example.jpg" alt="Body of the Letter Example" />
            <p>Now, it’s time to write about your feelings. Express your love, appreciation, and gratitude for your partner. Share what makes them special, how they make you feel, and why you're so grateful to have them in your life. Be honest and heartfelt!</p>
        </div>

        <!-- Step 5 -->
        <div class="step">
            <h2>Step 5: Closing Your Letter</h2>
            <img src="closing-example.jpg" alt="Closing Example" />
            <p>End your letter with a loving closing like "With all my love," "Forever yours," or "Yours always," followed by your name. Don’t forget to add a personal signature if you're sending a handwritten letter!</p>
        </div>

        <!-- Step 6 -->
        <div class="step">
            <h2>Step 6: Add a Special Touch (Optional)</h2>
            <img src="decoration-example.jpg" alt="Decorating Example" />
            <p>Add some personal flair by decorating the letter with hearts, doodles, or anything else that reminds you of your special connection. You could even write a poem, add a quote, or include a favorite shared memory!</p>
        </div>

        <!-- Back to Top Button -->
        <div class="button-container">
        <button class="back-button" onclick="window.location.href='../php/letter_making.php'">Go Back</button>
        </div>
    </div>
</body>
</html>
