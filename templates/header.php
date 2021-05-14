<?php 
if (!empty($_SESSION['t_id'])) { ?>
    <header class="header">
    <div class="header__container">
      <a href="index.php" class="header__logo">Search Teacher</a>
      <div class="header__profile">
        <span class="header__profile-name"><?=$_SESSION['t_name']?></span>
        <div class="header__profile-image">
          <img src="img/teachers/<?=$_SESSION['t_img']?>" alt="img">
        </div>
        <div class="profile-menu">
          <a class="profile-menu__to-profile profile-menu__link" href="teacher.php">
            <div class="profile-menu__image">
              <img src="img/teachers/<?=$_SESSION['t_img']?>" alt="img">
            </div>
            <div class="profile-menu__info">
              <span class="profile-menu__name"><?=$_SESSION['t_name']?> <?=$_SESSION['t_surname']?></span>
              <span class="profile-menu__description">Личный кабинет</span>
            </div>
          </a>
          <a class="profile-menu__logout profile-menu__link" href="logout.php">Выйти</a>
        </div>
      </div>
    </div>  
  </header>
<?php } else {
    if (!empty($_SESSION['s_id'])) { ?>
        <header class="header">
    <div class="header__container">
      <a href="index.php" class="header__logo">Search Teacher</a>
      <div class="header__profile">
        <span class="header__profile-name"><?=$_SESSION['s_name']?></span>
        <div class="header__profile-image">
          <img src="img/students/<?=$_SESSION['s_img']?>" alt="img">
        </div>
        <div class="profile-menu">
          <a class="profile-menu__to-profile profile-menu__link" href="student.php">
            <div class="profile-menu__image">
              <img src="img/students/<?=$_SESSION['s_img']?>" alt="img">
            </div>
            <div class="profile-menu__info">
              <span class="profile-menu__name"><?=$_SESSION['s_name']?> <?=$_SESSION['s_surname']?></span>
              <span class="profile-menu__description">Личный кабинет</span>
            </div>
          </a>
          <a class="profile-menu__logout profile-menu__link" href="logout.php">Выйти</a>
        </div>
      </div>
    </div>  
  </header>
        <?php } else { ?>
          <header class="header">
    <div class="header__container">
      <a href="index.php" class="header__logo">Search Teacher</a>
      <div class="header__auth">
        <div class="header__auth-icon">
          <i class="fa fa-user-o" aria-hidden="true"></i>
        </div>
        <div class="header__links">
          <a href="signin.php">Вход</a> <span>/</span> <a href="signup-selection.php">Регистрация</a>
        </div>
      </div>
    </div>  
  </header>
        <?php }
}
?>