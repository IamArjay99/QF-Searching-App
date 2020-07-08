<?php
    session_start();

    // Checking for directory
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if (strpos($url, 'pages') !== false) {
      $path = "../";
    } else {
      $path = "";
    }

    // This plugins allows you to connect multiple file
    require_once($path . 'plugins/phpti-master/ti.php');

    // It includes all the php class in classes/ using autoload
    include($path . 'includes/all.include.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QF Searching App</title>
    <!------------------------- CSS FILES ------------------------->
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap"
        rel="stylesheet"
    />
    <!-- Font Awesome CDN -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous"
    />
    <!-- Custom Styles -->
    <link rel="stylesheet" href="./<?= $path ?>dist/css/styles.min.css" />

    <?php emptyblock('another_css') ?>

    <!------------------------- JS FILES ------------------------->
    <!-- Chart CDN JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- JQuery CDN -->
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"
    ></script>

    <script src="<?= $path ?>dist/js/navbar.js"></script>

</head>
<body>
    <!------------------------- Navigation Bar ------------------------->
    <nav>
      <div class="nav-title">
        <a href="./<?= strpos($url, 'pages') !== false ? "../" : "" ?>index.php">
          <img src="./<?= $path ?>dist/img/covid.png" alt="QF Searching App Logo" />
          <span>QF Searching App</span>
        </a>
      </div>
      <div class="nav-menu">
          <i class="fa fa-bars" aria-hidden="true" id="nav-open"></i>
          <i
              class="fa fa-window-close-o"
              aria-hidden="true"
              id="nav-close"
          ></i>
          <ul class="menu">
              <li class="<?= strpos($url, 'index.php') !== false || strpos($url, 'pages') === false ? "active" : "" ?>">
                <a href="./<?= strpos($url, 'pages') !== false ? "../" : "" ?>index.php">Home</a>
              </li>
              <li class="<?= strpos($url, 'pages/news') !== false ? "active" : "" ?>">
                <a href="./<?= strpos($url, 'pages') !== false ? "" : "pages/" ?>news.php">News</a>
              </li>
              <li class="<?= strpos($url, 'pages/donation') !== false ? "active" : "" ?>">
                <a href="./<?= strpos($url, 'pages') !== false ? "" : "pages/" ?>donation.php">Donation</a>
              </li>
              <li class="<?= strpos($url, 'pages/aboutus') !== false ? "active" : "" ?>">
                <a href="./<?= strpos($url, 'pages') !== false ? "" : "pages/" ?>aboutus.php">About Us</a>
              </li>
              <li><a href="./<?= strpos($url, 'pages') !== false ? "" : "pages/" ?>signin.php" class="nav-btn">Sign In</a></li>
          </ul>
      </div>
    </nav>
    <div class="content">
        <?php emptyblock('main_content') ?>
    </div>           
    <!-- Use this method to add another script -->
    <?php emptyblock('another_js') ?>
</body>
</html>