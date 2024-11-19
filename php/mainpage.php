<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/mainpage.css" />
  <title>MainPage</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>
<header>
  <div class="logo">
    <img src="../images/logo eels.png" alt="logo" />
  </div>
</header>

<body>
  <h1>Welcome to EELS</h1>
  <p>
    Improve your English in a fun, friendly way! Our app is perfect for kids
    ages 7-13, offering interactive quizzes, stories, and challenges to help
    you learn new words, practice speaking, and build confidence. Join
    thousands of young learners who are building strong English skills while
    having fun every day!
  </p>


  <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
    <button type="button" class="btn btn-primary btn-lg px-4 gap-3" onclick="window.location.href='http://localhost/EELS/php/login.php'">SignIn</button>
    <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="window.location.href='http://localhost/EELS/php/signup.php'">Signup</button>
  </div>

</body>
<br>
<br>
<br>
<br>
<br>
<footer style="text-align: center">
  <ul style="display: inline-flex; list-style: none; padding: 0">
    <li>
      <a href="url" class="text-white me-3">
        <i class="bi bi-facebook" style="font-size: 1.5rem; color: white"></i>
      </a>
    </li>
    <li>
      <a href="url" class="text-white me-3">
        <i
          class="bi bi-instagram"
          style="font-size: 1.5rem; color: white"></i>
      </a>
    </li>
    <li>
      <a href="url" class="text-white me-3">
        <i class="bi bi-envelope" style="font-size: 1.5rem; color: white"></i>
      </a>
    </li>
  </ul>
</footer>

</html>