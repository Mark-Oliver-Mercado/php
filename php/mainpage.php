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

<header class="p-3">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img src="../images/logo eels.png" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="home nav-link px-0 text-secondary">Home</a></li>
        <li><a href="#about" class="about px--2 nav-link text-black">About</a></li>
      </ul>
    </div>
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

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <section id="about">
    <div class="container-fluid col-xxl-8 px-4 py-3">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="image col-10 col-sm-8 col-lg-6">
          <img src="../images/aboutus.jpeg" class="d-block mx-lg-auto" width="630" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
          <h1 class="title display-5 fw-bold text-body-emphasis lh-1 mb-3">About Us</h1>
          <p class="lead">Unlock the fun of learning English with EELS designed for kids ages 7-13! With interactive lessons, and personalized progress tracking, kids can improve their vocabulary, grammar, and reading skills in a fun and engaging way. Join thousands of young learners who are boosting their confidence in English every day. Start today and watch your child grow into a fluent English speaker!</p>
        </div>
      </div>
    </div>
  </section>



</body>

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