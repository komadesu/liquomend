<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';

// if (isset($_POST['email'])) {
//   $email = $_POST['email'];
// } elseif ($_SESSION['email_string']) {
//   $email = $_SESSION['email_string'];
// }
// if (isset($_POST['password'])) {
//   $pws = $_POST['password'];
// } elseif ($_SESSION['hash_password']) {
//   $pws = $_SESSION['hash_password'];
// }
if (isset($_POST['email'])) {
  $email = $_POST['email'];
}
if (isset($_POST['password'])) {
  $pws = $_POST['password'];
}


$errors = $_SESSION['errors'];

//入力されなかった場合
$_SESSION['errors']['empty'] = false;
//IDが間違えていた場合
$_SESSION['errors']['id'] = false;
//見つからなかった場合
$_SESSION['errors']['confirm'] = false;
//登録成功した場合
$_SESSION['good'] = false;



$emnum = strlen($email);
$pwnum = strlen($pws);

if ($_POST['login_btn']) {
  if ($emnum !== 0 && $pwnum !== 0) {

    $dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS") or die('Could not connect: ' . pg_last_error());


    $sql = "select * from liquomend.users where email = '$email' ;";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

    if (pg_num_rows($result)) {
      $user_info = pg_fetch_row($result);

      $user_id = $user_info[0];
      $user_name = $user_info[1];
      $hash_password = $user_info[3];


      if (password_verify($pws, $hash_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['email_string'] = $email;
        $_SESSION['hash_password'] = $hash_password;

        $_SESSION['good'] = true;
        header('Location: ./home.php');
      } else {
        $_SESSION['errors']['id'] = true;
      }
    } else {
      $_SESSION['errors']['confirm'] = true;
    }
  } else {
    $_SESSION['errors']['empty'] = true;
  }
}


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
  <title>Liquomend | Login</title>
  <link rel="stylesheet" href="./css/login.css" />
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
      <div class="login__notation">
        <p class="notation">ログイン画面です</p>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <div class="login">
              <h3 class="form__title">Sign In</h3>

              <form action="./login.php" method="POST" class="form">
                <label for="email" class="form__label">Email</label>
                <input id="email" type="email" name="email" class="form__email mb-2" />
                <br />

                <label for="password" class="form__label">パスワード</label>
                <input id="password" type="password" name="password" class="form__password" />
                <br />

                <div class="login__unvalid mb-4">
                  <a href='reset-login.php'>パスワードを忘れた場合</a>
                </div>
                <br />

                <?php
                if ($empty) {
                  echo "入力漏れがあります";
                } elseif ($id) {
                  echo "メールアドレスもしくはパスワードが間違っています";
                } elseif ($confirm) {
                  echo "そのようなメールアドレスは登録されていません";
                } elseif ($good) {
                  echo "ログイン成功！";
                  header('location: ./home.php');
                }
                ?>

                <div class="login__btns">
                  <input type="submit" name="login_btn" value="ログイン" class="form__btn" />
                  <p class="login__or__register">または</p>
                  <a href="./register.php" class="form__btn">新規登録</a>
                </div>
              </form>
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
          echo "<div class='mobile-menu__username'><a href='./mypage.php'>ユーザー</a></div>";
        } else {
          echo "<div class='mobile-menu__username'><a href='./mypage.php'>$uname</a></div>";
        }

        ?>



      </div>
      <div class="mobile-menu__body">
        <ul class="mobile-menu__main">
          <li class="mobile-menu__item">
            <a href="./home.php" class="mobile-menu__link">
              <span class="nav-main-title">Home</span>
              <span class="nav-sub-title">ホーム</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./mypage.php" class="mobile-menu__link">
              <span class="nav-main-title">My Page</span>
              <span class="nav-sub-title">マイページ</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./usual-menu.php" class="mobile-menu__link">
              <span class="nav-main-title">Usual Recipe</span>
              <span class="nav-sub-title">定番カクテル</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./mypage.php?component=favorite" class="mobile-menu__link">
              <span class="nav-main-title">Favorite</span>
              <span class="nav-sub-title">お気に入り</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./category.php" class="mobile-menu__link">
              <span class="nav-main-title">Category</span>
              <span class="nav-sub-title">カテゴリーから探す</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./search.php" class="mobile-menu__link">
              <span class="nav-main-title">Search</span>
              <span class="nav-sub-title">検索</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./about.php" class="mobile-menu__link">
              <span class="nav-main-title">About Us</span>
              <span class="nav-sub-title">私たちについて</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./mypage.php?component=settings" class="mobile-menu__link">
              <span class="nav-main-title">Settings</span>
              <span class="nav-sub-title">設定</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./post.php" class="mobile-menu__link">
              <span class="nav-main-title">Post</span>
              <span class="nav-sub-title">レシピ投稿</span>
            </a>
          </li>
        </ul>
        <div class="mobile-menu__logo">
          <img src="./img/logo2.png" alt="logo2 image" />
        </div>
        <div class="mobile-menu__sns">
          <a href="https://www.facebook.com/Liquomend" class="fb_icon icon"><img src="./img/facebook.png" alt="Facebook" /></a>
          <a href="https://www.instagram.com/liquomend" class="ig_icon icon"><img src="./img/instagram.png" alt="Instagram" /></a>
          <a href="https://twitter.com/@liqumend" class="tw_icon icon"><img src="./img/twitter.png" alt="Twitter" /></a>
        </div>
      </div>
    </nav>
  </div>
</body>

</html>