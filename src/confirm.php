<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

echo '<pre>';
echo var_dump(session_save_path());
echo dirname($_SERVER['DOCUMENT_ROOT']);
echo '</pre>';

require '../../../secret.php';
require './utils.php';



$uname = $_POST['username'];
$email = $_POST['email'];
$npw = $_POST['password'];
$cpw = $_POST['password_confirm'];


$errors = $_SESSION['errors'];

//文字が入力されていない場合
$_SESSION['errors']['empty'] = false;
//IDがかぶってしまっている場合
$_SESSION['errors']['id'] = false;
//pwの確認が取れなかった場合
$_SESSION['errors']['confirm'] = false;
//登録成功した場合
$_SESSION['good'] = false;

//パスワード等が入力されたかどうか
$unamenum = strlen($uname);
$npwnum = strlen($npw);
$cpwnum = strlen($cpw);

if ($unamenum == 0 || $npwnum == 0 || $cpwnum == 0) {
  $_SESSION['errors']['empty'] = true;
  header('location: ./register.php');
} else {

  $dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
    or die('Could not connect: ' . pg_last_error());

  $sql = "select * from liquomend.users where email = '$email' ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

  $rows = pg_num_rows($result);
  if ($rows == 1) {
    $_SESSION['errors']['id'] = true;
    header('location: ./register.php');
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Confirm</title>
  <link rel="stylesheet" href="./css/confirm.css" />
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
        <div class="confirm">
          <h3 class="form__title">登録確認画面</h3>

          <label for="username" class="form__label">User Name</label>
          <p class="control mb-2"><?php echo h($uname); ?></p>

          <label for="email" class="form__label">Email</label>
          <p class="control mb-2"><?php echo h($email); ?></p>

          <label for="password" class="form__label">パスワード</label>
          <p class="control mb-4">セキュリティの都合上表示されません</p>

          <div class="btns">
            <form action="register.php" method="POST" class="form__btn">
              <input type="hidden" name="username" value="<?php echo h($uname); ?>" />
              <input type="hidden" name="email" value="<?php echo h($email); ?>" />
              <input type="submit" value="戻る" />
            </form>

            <form action="thanks.php" method="POST" class="form__btn">
              <input type="hidden" name="username" value="<?php echo h($uname); ?>" />
              <input type="hidden" name="email" value="<?php echo h($email); ?>" />
              <input type="hidden" name="password" value="<?php echo h($npw); ?>">
              <input type="hidden" name="password_confirm" value="<?php echo h($cpw); ?>">
              <input type="submit" value="登録する" />
            </form>
          </div>
        </div>
      </div>

      <footer class="footer">
        <p class="footer__copyright"><small>&copy;gms.gdl.jp</small></p>
      </footer>
    </div>
    <nav class="mobile-menu">
      <div class="mobile-menu__profile">


        <?php

        echo '<div class="mobile-menu__icon">';

        if (!$uicon) {
          echo '<img src="./img/default-icon.svg" alt="icon sample image">';
        } else {
          echo '<img src="./img/$uicon" alt="icon image">';
        }

        echo '</div>';

        if (!$uname) {
          echo "<div class='mobile-menu__username'>ユーザー</div>";
        } else {
          echo "<div class='mobile-menu__username'>$uname</div>";
        }

        ?>


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
      <div class="mobile-menu__sns">
        <a href="https://www.facebook.com/Liquomend" class="fb_icon icon"><img src="./img/facebook.png" alt="Facebook" /></a>
        <a href="https://www.instagram.com/liquomend" class="ig_icon icon"><img src="./img/instagram.png" alt="Instagram" /></a>
        <a href="" class="tw_icon icon"><img src="./img/twitter.png" alt="Twitter" /></a>
      </div>
    </nav>
  </div>
</body>

</html>