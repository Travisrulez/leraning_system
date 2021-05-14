<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Links -->
  <link rel="stylesheet" href="styles/css/signup-selection.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Scripts -->
  <script src="scripts/main.js" defer></script>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <!-- Title -->
  <title>Регистрация</title>
</head>
<body>
<?php 
  require_once 'templates/header.php';
  ?>
  <section class="signup-selection">
    <a href="signup-student.php" class="signup-selection__link">
      <i class="signup-selection__icon fa fa-user" aria-hidden="true"></i>
      <span class="signup-selection__label">Я студент</span>
    </a>
    <a href="signup-teacher.php" class="signup-selection__link">
      <i class="signup-selection__icon fa fa-graduation-cap" aria-hidden="true"></i>
      <span class="signup-selection__label">Я преподаватель</span>
    </a>
  </section>
</body>
</html>