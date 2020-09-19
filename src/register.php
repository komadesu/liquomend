<?php
session_start();

require '../../../secret.php';
require './utils.php';




$uname = $_POST['username'];
$email = $_POST['email'];


if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];

  if (isset($errors['empty'])) {
    $empty = $errors['empty'];
  }

  if (isset($errors['id'])) {
    $id = $errors['id'];
  }

  if (isset($errors['confirm'])) {
    $confirm = $errors['confirm'];
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Sign Up</title>
  <link rel="stylesheet" href="./css/register.css" />
</head>

<body>
  <div id="global-container">
    <div id="contents-container">
      <div class="mobile-menu__cover"></div>
      <header class="header m-3">
        <button onclick="document.querySelector('#global-container').classList.toggle('menu-open')" class="mobile-menu__btn">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </header>
      <div class="hero">
        <div class="hero__logo-img">
          <img src="./img/logo.png" alt="logo image" />
        </div>
        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
      </div>
      <nav class="nav">
        <ul class="nav__list">
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
        </ul>
      </nav>

      <div class="container">
        <div class="register">
          <h3 class="form__title">Sign Up</h3>
          <form action="confirm.php" method="POST" class="form">
            <label for="username" class="form__label">User Name</label>
            <input id="username" type="text" name="username" value="<?php echo h($uname); ?>" class="form__username mb-2" />
            <br />

            <label for="email" class="form__label">Email</label>
            <input id="email" type="email" name="email" value="<?php echo h($email); ?>" class="form__email mb-2" />
            <br />

            <label for="password" class="form__label">パスワード</label>
            <input id="password" type="password" name="password" class="form__password mb-2" />
            <br />

            <label for="password_confirm" class="form__label">パスワード(確認用)</label>
            <input id="password_confirm" type="password" name="password_confirm" class="form__password mb-4" />
            <br />


            <?php
            if ($empty) {
              echo "入力漏れがあります";
            }
            if ($id) {
              echo "すでにそのIDは使用されています";
            }
            if ($confirm) {
              echo "確認用パスワードと異なっています";
            }

            session_destroy();
            ?>


            <input type="submit" value="登録確認画面へ" class="form__btn" />
          </form>
        </div>
      </div>

      <footer class="footer">
        <p class="footer__copyright"><small>&copy;gms.gdl.jp</small></p>
      </footer>
    </div>
    <nav class="mobile-menu">
      <div class="mobile-menu__profile">
        <div class="mobile-menu__icon">
          <img src="./img/sampleDrink.jpg" alt="icon sample image" />
        </div>
        <div class="mobile-menu__username">User Name</div>
      </div>
      <ul class="mobile-menu__main">
        <li class="mobile-menu__item">
          <a href="./home.html" class="mobile-menu__link">
            <span class="nav-main-title">Home</span>
            <span class="nav-sub-title">ホームへ戻る</span>
          </a>
        </li>
        <li class="mobile-menu__item">
          <a href="./about.html" class="mobile-menu__link">
            <span class="nav-main-title">About</span>
            <span class="nav-sub-title">お問い合わせ</span>
          </a>
        </li>
        <li class="mobile-menu__item">
          <a href="./login.html" class="mobile-menu__link">
            <span class="nav-main-title">Log In</span>
            <span class="nav-sub-title">ログイン</span>
          </a>
        </li>
        <li class="mobile-menu__item">
          <a href="＃" class="mobile-menu__link">
            <span class="nav-main-title">ページ</span>
            <span class="nav-sub-title">なんとかページ</span>
          </a>
        </li>
      </ul>
      <div class="mobile-menu__logo">
        <img src="./img/logo2.png" alt="logo2 image" onclick="location.href = './about.php'">
      </div>
      <div class="mobile-menu__sns">各種logoが入ります</div>
    </nav>
  </div>
</body>

</html>