<!DOCTYPE html>
<html>
<head>
    <title>SuperRent</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-dark fixed-top bg-dark">
  <a class="navbar-brand">SuperRent</a>
    <ul class="nav nav-pills pull-right">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    </ul>
</nav>
<?php displayMessage(); ?>