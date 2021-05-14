<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require_once 'core/connection.php';
require_once 'core/functions.php';
// echo $_SESSION['s_id'];
// echo $_SESSION['s_name'];
$sid = $_SESSION['s_id'];
$sql = "SELECT * FROM students WHERE id = '".$sid."'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_array($res);
// echo $row['name'];
if (isset($_POST['submit1'])) {
  $fname = $_FILES['file']['name'];
  $temp = $_FILES['file']['tmp_name'];
  $fsize = $_FILES['file']['size'];
  $extension = explode('.',$fname);
  $extension = strtolower(end($extension));  
  $fnew = uniqid().'.'.$extension;
  $store = "img/students/".basename($fnew);  
  if($extension == 'jpg'||$extension == 'png'||$extension == 'gif') {
    $sqql = "UPDATE students SET img='$fnew' WHERE id = '$sid'";
    mysqli_query($con, $sqql); 
    $sqqql = "UPDATE teacher_students SET img='$fnew' WHERE s_id = '$sid'";
    mysqli_query($con, $sqqql); 
    move_uploaded_file($temp, $store);
    header('location: student.php');
  } }
if (isset($_POST['submit'])) {
  $ssql = "UPDATE students SET name = '$_POST[name]',  surname = '$_POST[surname]',  patronymic = '$_POST[patronymic]', region = '$_POST[region]', phone = '$_POST[phone]', email = '$_POST[email]', password = '$_POST[password]' WHERE id = '$sid'";
  mysqli_query($con, $ssql);
  header('location: student.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Links -->
  <link rel="stylesheet" href="styles/css/teacher.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Scripts -->
  <script src="scripts/main.js" defer></script>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <!-- Title -->
  <title>Ученик</title>
</head>
<body>
  <!-- Header -->
  <?php 
  require_once 'templates/header.php';
  ?>

  <!-- Profile -->
  <section class="profile">
    <div class="profile__container _container">
    <div class="profile__image profile-image">
        <form action="" method='post' enctype="multipart/form-data">
        <?php if ($row['img'] == "student-icon.png") { ?>
          <img src="img/students/student-icon.png" alt="profile-image">
        <?php } else { ?>
          <img src="img/students/<?=$row['img']?>" alt="profile-image">
        <?php } ?>
          <!-- <img src="img/profile-img.jpg" alt="profile-image"> -->
          <div class="profile-image__upload">
            <img src="img/upload.png" alt="upload">
            <label for="image"></label>
            <input type="file" name="file" id="image">
          </div>
          <button class="profile-image__btn btn" type="submit" name="submit1">Обновить изображение</button>
        </form>
      </div>
      <div class="profile__data">
        <form action="" method="post" class="profile__form">
          <div class="profile__form-group form-group">
            <div class="form-group__item">
              <label for="name">Имя</label>
              <input name="name" id="name" type="text" class="input" value="<?=$row['name']?>">
            </div>
            <div class="form-group__item">
              <label for="surname">Фамилия</label>
              <input name="surname" id="surname" type="text" class="input" value="<?=$row['surname']?>">
            </div>
            <div class="form-group__item">
              <label for="patronymic">Отчество</label>
              <input name="patronymic" id="patronymic" type="text" class="input" value="<?=$row['patronymic']?>">
            </div>
            <div class="form-group__item">
              <label for="region">Регион проживания</label>
              <input name="region" id="region" type="text" class="input" value="<?=$row['region']?>">
            </div>
            <button class="profile__submit-btn btn" name="submit">Сохранить изменения</button>
          </div>

          <div class="profile__form-group form-group">
            <div class="form-group__item">
              <label for="phone">Телефон</label>
              <input name="phone" id="phone" type="text" class="input" value="<?=$row['phone']?>">
            </div>
            <div class="form-group__item">
              <label for="email">Email</label>
              <input name="email" id="email" type="email" class="input" value="<?=$row['email']?>">
            </div>
            <div class="form-group__item">
              <label for="password">Пароль</label>
              <input name="password" id="password" type="password" class="input" value="<?=$row['password']?>">
              <div class="toggle-password">
                <i class="show fa fa-eye" aria-hidden="true"></i>
                <i class="hide fa fa-eye-slash" aria-hidden="true"></i>
              </div>
            </div>
            <div class="form-group__item">
              <label for="position">Должность</label>
              <input name="position" id="position" type="text" class="input" value="Студент" disabled>
            </div>
          </div>
          <button class="profile__submit-btn btn mobile-btn" name="submit" type="submit">Сохранить изменения</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Workspace -->
  <section class="workspace">
    <div class="workspace__container _container">
      <!-- Students -->
      <div class="students">
        <div class="students__title">
          <h2>Преподаватели</h2>
          <div class="students__content">
          <?php
            $teach = get_teachers($sid);
            foreach ($teach as $teachers):
          ?>
            <div class="students__item card">
              <div class="card__wrapper">
                <div class="card__image">
                  <img src="img/teachers/<?=$teachers['img']?>" alt="image">
                </div>
                <div class="card__details">
                  <div class="card__lesson"><?=$teachers['task']?></div>
                  <div class="card__name"><?=$teachers['name']?> <?=$teachers['surname']?> <?=$teachers['patronymic']?></div>
                </div>
              </div>
              <div class="card__contact">
                <a class="btn" href="tel:<?=$teachers['phone']?>">Связаться</a>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>  
  </section>

  <script src="https://unpkg.com/imask"></script>
  <script>
    const passwordInput = document.querySelector('#password');
    const toggleBtn = document.querySelector('.toggle-password');

    toggleBtn.addEventListener('click', () => {
      if (passwordInput.getAttribute('type') === 'password') {
        toggleBtn.classList.add('show');
        passwordInput.setAttribute('type', 'text');
      } else {
        toggleBtn.classList.remove('show');
        passwordInput.setAttribute('type', 'password');
      }
    })

    const phoneMask = IMask(
    document.getElementById('phone'), {
      mask: '+{7} (000) 000-00-00'
    });
  </script>
</body>
</html>