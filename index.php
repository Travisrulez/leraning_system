<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require_once 'core/connection.php';
require_once 'core/functions.php';
// $id = $_SESSION['t_id'];
// echo $_SESSION['t_id'];
// echo $_SESSION['s_name'];
if (isset($_POST['signup'])) {
  if (empty($_SESSION['t_id'])) {
    $sql = "INSERT INTO teacher_students(t_id, s_id, name, surname, patronymic, task, phone, img) VALUE('".$_POST['t_id']."', '".$_SESSION['s_id']."', '".$_SESSION['s_name']."',  '".$_SESSION['s_surname']."', '".$_SESSION['s_patronymic']."', '".$_POST['task']."', '".$_SESSION['s_phone']."', '".$_SESSION['s_img']."')";
    mysqli_query($con, $sql);
    $ssql = "INSERT INTO student_teachers(s_id, t_id, task, name, surname, patronymic, phone, img) VALUE('".$_SESSION['s_id']."', '".$_POST['t_id']."', '".$_POST['task']."', '".$_POST['firstname']."', '".$_POST['surname']."', '".$_POST['patronymic']."', '".$_POST['phone']."', '".$_POST['img']."')";
    mysqli_query($con, $ssql);
    // echo $_POST['phone'];
    header('location: index.php');
  } else {
    $sql = "INSERT INTO teacher_students(t_id, name, surname, patronymic, task, phone, img) VALUE('".$_POST['t_id']."', '".$_SESSION['t_name']."',  '".$_SESSION['t_surname']."', '".$_SESSION['t_patronymic']."', '".$_POST['task']."', '".$_POST['phone']."', '".$_SESSION['t_img']."')";
    mysqli_query($con, $sql);
    header('location: index.php');
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
  <link rel="stylesheet" href="styles/css/style.min.css">
  <!-- Scripts -->
  <script src="scripts/main.js" defer></script>
  <script src="scripts/modal.js" defer></script>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;900&display=swap" rel="stylesheet">
  <!-- Title -->
  <title>Learning System</title>
</head>
<body>
  <?php 
  require_once 'templates/header.php';
  ?>
  <!-- Search Teacher -->
  <section class="search-teacher">
    <h2>Введите название предмета</h2>
    <form action="search.php" method="get" class="search-teacher__input-form">
      <input
        type="text"
        class="search-teacher__input"
        name="search"
        id="search-teacher"
        placeholder="Найти преподавателя"  
      >
      <button class="search-teacher__button">
        <img src="img/search.png" alt="search">
      </button>
    </form>
  </section>
  <!-- Teachers -->
  <section class="teachers">
    <div class="_container teachers__container">
      <h1>Преподаватели</h1>
      <?php 
      $cards = get_all_cards();
      // $_SESSION['task'] = $cards['id'];
      foreach ($cards as $card):
        $id = $card['t_id'];
        $teacher = "SELECT * FROM teachers WHERE id = '".$id."'";
      $resss = mysqli_query($con, $teacher);
      $rowww = mysqli_fetch_array($resss);
      ?>
      <div class="teacher teachers__item">
        <div class="teacher__wrapper">
          <div class="teacher__image">
            <?php if ($card['img'] == "teacher-icon.png") { ?>
              <img src="img/teachers/teacher-icon.png" alt="teacher">
            <?php } else { ?>
              <img src="img/teachers/<?=$card['img']?>" alt="teacher">
            <?php } ?>
          </div>
          <div class="teacher__details">
          <form action="" method="post">
          <input type="text" name="firstname" value="<?=$rowww['name']?>" style="display: none;">
          <input type="text" name="surname" value="<?=$rowww['surname']?>" style="display: none;">
          <input type="text" name="patronymic" value="<?=$rowww['patronymic']?>" style="display: none;">
          <input type="text" name="phone" value="<?=$rowww['phone']?>" style="display: none;">
          <input type="text" name="img" value="<?=$rowww['img']?>" style="display: none;">
            <input type="text" name="t_id" value="<?=$card['t_id']?>" style="display: none;">
            <div class="teacher__lesson"><input type="text" name="task" value="<?=$card['name']?>" style="display: none;"><?=$card['name']?></div>
            <div class="teacher__name"><?=$card['firstname']?> <?=$card['surname']?> <?=$card['patronymic']?></div>
          </div>
        </div>
        <div class="teacher__contact">
          <span class="teacher__price"><?=$card['price']?></span>
          <?php 
          // $_SESSION['task'] = $card['name'];
          if (empty($_SESSION['t_id'])) {
            echo '<button class="btn teacher__btn" name="signup" type="submit">Записаться</button>';
          } else {
            if ($_SESSION['t_id'] == $card['t_id']) { ?>
                            <a class="btn" href="del-card.php?del_card=<?=$card['id']?>" title="Удалить">Удалить</a>
            <?php } else {
              echo '<button class="btn disabled teacher__btn" name="signup" type="submit" disabled>Нет доступа</button>';
            }
          }
          ?>
          </form>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </section>

  <!-- Subscribe -->
  <section class="subscribe">
    <div class="subscribe__content">
      <p>Подпишитесь, чтобы не пропустить обновления</p>
      <button class="btn subscribe__btn">Подписаться</button>
    </div>
    <div class="subscribe__background"></div>
  </section>

  <!-- Modal -->
  <?php 
  if (isset($_POST['subscribe'])) {
    $subs = "INSERT INTO feedback(name, email) VALUE('".$_POST['name']."', '".$_POST['email']."')";
    mysqli_query($con, $subs);
    header('location: index.php');
  }
  ?>
  <div class="modal">
    <form class="modal__form" method="post" action="">
      <div class="modal__form-item">
        <label for="name">Имя</label>
        <input
          class="modal__input input"
          type="text"
          id="name"
          name="name"
          required
        >
      </div>
      <div class="modal__form-item">
        <label for="email">Email</label>
        <input
          class="modal__input input"
          type="email"
          id="email"
          name="email"
          required
        >
      </div>
      <button class="modal__btn btn" name="subscribe">Подписаться</button>
    </form>
    <div class="modal__close">
      &#10006;
    </div>
  </div>
  <div class="overlay"></div>

  <script>
    const prices = document.querySelectorAll('.teacher__price');
    prices.forEach(item => {
      const output = new Intl.NumberFormat('ru-RU', {
        style: 'currency',
        currency: 'RUB'
      }).format(item.textContent)
      item.textContent = output.replace(/,../, '');
    })
  </script>
</body>
</html>