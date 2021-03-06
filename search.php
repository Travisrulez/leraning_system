<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();
require_once 'core/connection.php';
require_once 'core/functions.php';
// $id = $_SESSION['t_id'];
// echo $_SESSION['t_id'];
// echo $_SESSION['s_name'];
$search_get = $_GET['search'];
// echo $search_get;
if ($search_get == "") {
    header("location:index.php");
}
elseif ($search_get == " ") {
    header("location:index.php");
}
else {
    $sqll = "SELECT * FROM teacher_cards WHERE name LIKE '%$search_get%' OR firstname LIKE '%$search_get%' OR surname LIKE '%$search_get%' OR patronymic LIKE '%$search_get%' ORDER BY id DESC";
    $select = mysqli_query($con, $sqll);
    $search_row = mysqli_num_rows($select);

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
  <!-- Header -->
  <?php 
  require_once 'templates/header.php';
  ?>
  <!-- Search Teacher -->
  <section class="search-teacher">
    <h2>?????????????????? ???????????? ???? ??????????????: "<?=$search_get?>" (<?=$search_row?>)</h2>
    
  </section>
  <!-- Teachers -->
  <section class="teachers">
    <div class="_container teachers__container">
      <?php 
     
      while ($select_while = mysqli_fetch_assoc($select)) {
        
        $id = $select_while['t_id'];
        $teacher = "SELECT * FROM teachers WHERE id = '".$id."'";
      $resss = mysqli_query($con, $teacher);
      $rowww = mysqli_fetch_array($resss);
      ?>
      <div class="teacher teachers__item">
        <div class="teacher__wrapper">
          <div class="teacher__image">
          <?php if ($select_while['img'] == "teacher-icon.png") { ?>
              <img src="img/teachers/teacher-icon.png" alt="teacher">
            <?php } else { ?>
              <img src="img/teachers/<?=$select_while['img']?>" alt="teacher">
            <?php } ?>
          </div>
          <div class="teacher__details">
          <form action="" method="post">
          <input type="text" name="firstname" value="<?=$rowww['name']?>" style="display: none;">
      <input type="text" name="surname" value="<?=$rowww['surname']?>" style="display: none;">
      <input type="text" name="patronymic" value="<?=$rowww['patronymic']?>" style="display: none;">
      <input type="text" name="phone" value="<?=$rowww['phone']?>" style="display: none;">
            <input type="text" name="t_id" value="<?=$select_while['t_id']?>" style="display: none;">
            <div class="teacher__lesson"><input type="text" name="task" value="<?=$select_while['name']?>" style="display: none;"><?=$select_while['name']?></div>
            <div class="teacher__name"><?=$select_while['firstname']?> <?=$select_while['surname']?> <?=$select_while['patronymic']?></div>
          </div>
        </div>
        <div class="teacher__contact">
          <span class="teacher__price"><?=$select_while['price']?></span>
          <?php 
          // $_SESSION['task'] = $card['name'];
          if (!empty($_SESSION['s_id'])) {
            echo '<button class="btn teacher__btn" name="signup" type="submit">????????????????????</button>';
          } elseif (!empty($_SESSION['t_id'])) {
            if ($_SESSION['t_id'] == $select_while['t_id']) { ?>
                            <a class="btn" href="del-card.php?del_card=<?=$select_while['id']?>" title="??????????????">??????????????</a>
            <?php } else {
              echo '<button class="btn disabled teacher__btn" name="signup" type="submit" disabled>?????? ??????????????</button>';
            }
          } else {
            echo '<button class="btn teacher__btn" name="signup" type="submit"><a href="signup-selection.php">????????????????????</a></button>';
          }
          ?>
          </form>
        </div>
      </div>
      <?php } ?>

    </div>
  </section>

  <!-- Subscribe -->
  <section class="subscribe">
    <div class="subscribe__content">
      <p>??????????????????????, ?????????? ???? ???????????????????? ????????????????????</p>
      <button class="btn subscribe__btn">??????????????????????</button>
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
        <label for="name">??????</label>
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
      <button class="modal__btn btn" name="subscribe">??????????????????????</button>
    </form>
    <div class="modal__close">
      &#10006;
    </div>
  </div>
  <div class="overlay"></div>
<?php } ?>
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