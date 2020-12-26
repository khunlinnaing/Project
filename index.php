<!DOCTYPE html>
<html>
<head>
  <title>index</title>
  <link rel="shortcut icon" href="image/logo.png" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/nav_action.js"></script>
</head>
<body>
<header>
  <?php
    require "view/header.php";
  ?>  
</header>
<main>
  <?php
    require "view/body.php";
  ?>
</main>
<footer>
  <?php
    require "view/footer.php";
    require "action/javascrip.php";
  ?>
</footer>
</body>
</html>