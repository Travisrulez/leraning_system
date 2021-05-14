<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
require_once 'core/connection.php';
if (isset($_POST['submit'])) {
  $check_phone = mysqli_query($con, "SELECT phone FROM students WHERE phone = '".$_POST['phone']."'");
  $check_email = mysqli_query($con, "SELECT email FROM students WHERE email = '".$_POST['email']."'");
  if ($_POST['password'] != $_POST['repeat']) {
    $mes = "Пароли не совпадают";
  }elseif (mysqli_num_rows($check_phone) > 0) {
    $mes = "Такой номер телефона уже используется";
  }elseif (mysqli_num_rows($check_email) > 0) {
    $mes = "Такая почта уже используется";
  }else {
    // $pas = md5($_POST['password']);
    $sql = "INSERT INTO students(name, surname, patronymic, email, phone, region, password) VALUES ('".$_POST['name']."','".$_POST['surname']."','".$_POST['patronymic']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['region']."','".$_POST['password']."')";
    mysqli_query($con, $sql);
    header("refresh:0;url=signin.php");
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
  <link rel="stylesheet" href="styles/css/signup.min.css">
  <!-- Scripts -->
  <script src="scripts/main.js" defer></script>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <!-- Title -->
  <title>Регистрация ученика</title>
</head>
<body>
<?php 
  require_once 'templates/header.php';
  ?>
  <section class="signup">
    <h1>Регистрация</h1>
    <form action="" method="post" class="signup__form">
      <input
        class="input"
        type="text"
        placeholder="Имя"
        name="name"
        required
      >
      <input
        class="input"
        type="text"
        placeholder="Фамилия"
        name="surname"
        required
      >
      <input
        class="input"
        type="text"
        placeholder="Отчество"
        name="patronymic"
        required
      >
      <input
        class="input"
        type="email"
        placeholder="Email"
        name="email"
        required
      >
      <input
        class="input"
        id="phone"
        type="text"
        placeholder="Мобильный телефон"
        name="phone"
        required
      >
      <input
        class="input"
        type="text"
        placeholder="Регион проживания"
        name="region"
        required
      >
      <input
        class="input"
        type="password"
        placeholder="Пароль"
        name="password"
        required
      >
      <input
        class="input"
        type="password"
        placeholder="Повторите пароль"
        name="repeat"
        required
      >

      <div class="check">
        <input type="checkbox" name="check" id="check" required>
        <label for="check">Я принимаю условия <a href="#">пользовательского соглашения</a></label>
      </div>

      <button class="btn" name="submit" type="submit">Зарегистрироваться</button>
    </form>
    <?php 
    echo $mes;
    ?>
  </section>

  <script src="https://unpkg.com/imask"></script>
  <script>
    const phoneMask = IMask(
    document.getElementById('phone'), {
      mask: '+{7} (000) 000-00-00'
    });
  </script>
</body>
</html>