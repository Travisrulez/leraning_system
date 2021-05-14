<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require_once 'core/connection.php';
$edit = $_GET['edit_card'];
$sql = "SELECT * FROM teacher_cards WHERE id = '".$edit."'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
if (isset($_POST['submit'])) {
  $sql = "UPDATE teacher_cards SET name = '$_POST[name]',  price = '$_POST[price]' WHERE id = '".$edit."'";
  mysqli_query($con, $sql);
  header("location: edit-card.php?edit_card=$edit");
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
  <title>Редактировать карточку</title>
</head>
<body>
<?php 
  require_once 'templates/header.php';
  ?>
  <section class="signin">
    <h1>Редактировать карточку</h1>
    <form action="" method="post" class="signin__form">
      <input
        class="input"
        type="text"
        value="<?=$row['name']?>"
        name="name"
      >
      <input
        class="input"
        type="number"
        value="<?=$row['price']?>"
        name="price"
      >
      <button class="btn" name="submit" type="submit">Редактировать карточку</button>
      <a class="btn btn-cancel" href="teacher.php" type="submit">Назад к профилю</a>
    </form>
  </section>
</body>
</html>