<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require_once 'core/connection.php';
$tid = $_SESSION['t_id'];
$tname = $_SESSION['t_name'];
$tsurname = $_SESSION['t_surname'];
$tpatronymic = $_SESSION['t_patronymic'];
// echo $tname;
if (isset($_POST['submit'])) {
  $sql = "INSERT INTO teacher_cards(name, price, firstname, surname, patronymic, t_id, img) VALUE('".$_POST['name']."', '".$_POST['price']."', '".$tname."', '".$tsurname."', '".$tpatronymic."','".$tid."', '".$_SESSION['t_img']."')";
  mysqli_query($con, $sql);
  // header('location: teacher.php');
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
  <title>Добавить карточку</title>
</head>
<body>
<?php 
  require_once 'templates/header.php';
  ?>
  <section class="signin">
    <h1>Добавить карточку</h1>
    <form action="" method="post" class="signin__form">
      <input
        class="input"
        type="text"
        placeholder="Название карточки"
        name="name"
        required
      >
      <input
        class="input"
        type="number"
        placeholder="Стоимость"
        name="price"
        required
      >
      <button class="btn" name="submit" type="submit">Добавить карточку</button>
      <a class="btn btn-cancel" href="teacher.php" type="submit">Назад к профилю</a>
    </form>
  </section>
</body>
</html>