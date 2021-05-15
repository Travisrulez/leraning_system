<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();
require_once 'core/connection.php';
if (isset($_POST['submit'])) {
  $check_student = mysqli_query($con, "SELECT * FROM students WHERE email = '".$_POST['email']."' && password = '".$_POST['password']."'");
  if (mysqli_num_rows($check_student) > 0) {
  $login = "SELECT * FROM students WHERE email = '".$_POST['email']."' && password = '".$_POST['password']."'";
$res = mysqli_query($con, $login);
$row = mysqli_fetch_array($res);
if (is_array($row)) {
  $_SESSION['s_id'] = $row['id'];
  $_SESSION['s_name'] = $row['name'];
  $_SESSION['s_surname'] = $row['surname'];
  $_SESSION['s_patronymic'] = $row['patronymic'];
  $_SESSION['s_phone'] = $row['phone'];
  $_SESSION['s_img'] = $row['img'];
  header("refresh:0;url=student.php");
}else {
    $mes = "Неверный логин или пароль";
}
  }
  else {
    $login_t = "SELECT * FROM teachers WHERE email = '".$_POST['email']."' && password = '".$_POST['password']."'";
$rest = mysqli_query($con, $login_t);
$roww = mysqli_fetch_array($rest);
if (is_array($roww)) {
  $_SESSION['t_id'] = $roww['id'];
  $_SESSION['t_name'] = $roww['name'];
  $_SESSION['t_surname'] = $roww['surname'];
  $_SESSION['t_patronymic'] = $roww['patronymic'];
  $_SESSION['t_phone'] = $roww['phone'];
  $_SESSION['t_img'] = $roww['img'];
  header("refresh:0;url=teacher.php");
}else {
    $mes = "Неверный логин или пароль";
}
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Links -->
  <link rel="stylesheet" href="styles/css/signin.min.css">
  <!-- Scripts -->
  <script src="scripts/main.js" defer></script>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <!-- Title -->
  <title>Вход</title>
</head>
<body>
<?php 
  require_once 'templates/header.php';
  ?>
  <section class="signin">
    <h1>Вход</h1>
    <form action="" method="post" class="signin__form">
      <input
        class="input"
        type="email"
        placeholder="Email"
        name="email"
      >
      <input
        class="input"
        type="password"
        placeholder="Пароль"
        name="password"
      >
      <button class="btn" type="submit" name="submit">Войти</button>
    </form>
    <?php echo $mes; ?>
  </section>
</body>
</html>