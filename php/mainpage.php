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
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map {
      height: 500px;
      width: 100%;
    }
  </style>
</head>
<header>
  <div class="logo">
    <a href="#" class="d-flex">
      <img src="../images/logo eels.png" alt="Logo" id="logo">
    </a>
  </div>
  <div>
    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="home nav-link px-0 text-secondary">Home</a></li>
      <li><a href="#about" class="about px--2 nav-link text-black">About</a></li>
      <li><a href="#" class="contact px--2 nav-link text-black">Contacts</a></li>
    </ul>
  </div>
</header>


<body>
  <div>
    <h1 class="name">Welcome to EELS</h1>
    <div>
      <p class="descri"> Improve your English in a fun, friendly way! Our app is perfect for kids
        ages 7-13, offering interactive quizzes, stories, and challenges to help
        you learn new words, practice speaking, and build confidence. Join
        thousands of young learners who are building strong English skills while
        having fun every day!</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-primary btn-lg px-4 gap-3" onclick="window.location.href='http://localhost/EELS/php/login.php'">SignIn</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="window.location.href='http://localhost/EELS/php/signup.php'">Signup</button>
      </div>
    </div>
  </div>


  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <section id="about">
    <div class="container-fluid col-xl-10 col-xxl-8 px-4 py-5">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <h1 class="title display-4 fw-bold lh-1 text-body-emphasis mb-3">About Us</h1>
          <p class="lead col-lg-10 fs-4">Unlock the fun of learning English with EELS designed for kids ages 7-13! With interactive lessons, and personalized progress tracking, kids can improve their vocabulary, grammar, and reading skills in a fun and engaging way. Join thousands of young learners who are boosting their confidence in English every day. Start today and watch your child grow into a fluent English speaker!</p>
        </div>
      </div>
    </div>
  </section>

  <section class="mapping">

    <div class="map-description">
      <h3>Batangas State University Library</h3>
    </div>

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Link to Leaflet.js JS Library -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
      // Initialize the map centered on Batangas State University Malvar Campus
      const map = L.map('map').setView([14.044824, 121.156304], 10); // Coordinates for Batangas State University Malvar Campus

      // Set the tile layer to OpenStreetMap
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      // Add a marker for Batangas State University Malvar Campus
      const marker1 = L.marker([14.044824, 121.156304]).addTo(map);
      marker1.bindPopup("<b>Batangas State University - Malvar Campus");

      // Add another marker for a different location
      const marker2 = L.marker([13.956872, 121.163120]).addTo(map);
      marker2.bindPopup("<b>Batangas State University - Lipa Campus");

      const marker3 = L.marker([13.846757, 121.196687]).addTo(map);
      marker3.bindPopup("<b>Batangas State University - Rosario Campus");

      const marker4 = L.marker([13.754171, 121.053023]).addTo(map);
      marker4.bindPopup("<b>Batangas State University - Pablo Borbon Campus");
    </script>
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