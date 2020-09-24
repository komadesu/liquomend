<?php
ini_set('session.save_path', realpath('./../session'));
session_start();


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
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Thanks</title>
  <link rel="stylesheet" href="./css/thanks.css" />
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
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <div class="confirm">
              <h3 class="form__title">登録完了画面</h3>

              <?php
              if (!$rows) {

                if ($npw === $cpw) {
                  $hpw = password_hash($npw, PASSWORD_DEFAULT);

                  $sql = "insert into liquomend.users (uname, email, hash_password, uicon) values ('$uname', '$email', '$hpw', null);";
                  $result = pg_query($sql) or die('query failed: ' . pg_last_error());
                  $_SESSION['good'] = true;


                  echo '<label class="form__label">Thanks!</label>';
                  echo '<p class="control mb-4">登録が完了しました</p>';
                  echo '<br>';
                  echo '<p>ホーム画面へ移動します...</p>';

                  $mailfr = "1gk8296t@gms.gdl.jp";
                  $mailsb = "[Liquomend]ユーザ登録完了";
                  $mailms = "ユーザ登録を完了しました。\n\n";
                  "   ユーザ名:" . $uname . "\n";
                  "http://gms.gdl.jp/~tenten1717/\n\n";
                  if (mb_send_mail($email, $mailsb, $mailms, "From: " . $mailfr)) {
                    echo "<p>メールが送信されました。</p>";
                  } else {
                    echo "<p>メールの送信に失敗しました。</p>";
                  }

                  $_SESSION['user_name'] = $uname;
                  $_SESSION['email_string'] = $email;
                  $_SESSION['hash_password'] = $hpw;

                  // sleep(3);

                  header('location: ./home.php');
                } else {
                  $_SESSION['errors']['confirm'] = true;

                  header('location: ./register.php');
                }
              } else {
                $_SESSION['errors']['id'] = true;
                header('location: ./register.php');
              }
              ?>

            </div>
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