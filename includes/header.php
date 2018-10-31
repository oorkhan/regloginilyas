<?php ob_start();
session_start(); require_once 'includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Registration login system</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/reglogin">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contacts</a></li>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>
        <li>
          <a class='dropdown-trigger btn blue' href='#' data-target='dropdown1'><?= $_SESSION["username"] ?></a>
          <ul id='dropdown1' class='dropdown-content'>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="welcome.php">Posts</a></li>
            <li><a href="logout.php">Log out</a></li>
          </ul>
        </li>
      <?php }else{ ?>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
      <?php } ?>

      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="/reglogin">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contacts</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
