<?php
session_start();


require '../../../secret.php';

if (isset($_POST['email'])) {
  $email = $_POST['email'];
} elseif ($_SESSION['email_string']) {
  $email = $_SESSION['email_string'];
}
if (isset($_POST['password'])) {
  $pws = $_POST['password'];
} elseif ($_SESSION['hash_password']) {
  $pws = $_SESSION['hash_password'];
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

echo 'login called';
echo var_dump($email);
echo var_dump($pws);


if ($emnum !== 0 && $pwnum !== 0) {
  $sql = "select * from liquomend.user where email = '$email' ;";
  $dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS") or die('Could not connect: ' . pg_last_error());

  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

  if (pg_num_rows($result)) {
    $row = pg_fetch_row($result);
    if (password_verify($pws, $row[3])) {
      $_SESSION['email_string'] = $email;
      $_SESSION['hash_password'] = $row[3];
      echo 'password verified';
      echo var_dump($email);
      echo var_dump($row[3]);

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

// if (isset($_SESSION['good'])) {
//   $good = $_SESSION['good'];

//   header("location: ./home.php");
//   exit;
// }
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
      <nav class="nav">
        <ul class="nav__list">
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
        </ul>
      </nav>

      <div class="container">
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
            session_destroy();
            ?>

            <div class="login__btns">
              <input type="submit" value="ログイン" class="form__btn" />
              <p class="login__or__register">または</p>
              <input type="submit" value="新規登録" class="form__btn" />
            </div>
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
          <a href="＃" class="mobile-menu__link">
            <span class="nav-main-title">ページ</span>
            <span class="nav-sub-title">なんとかページ</span>
          </a>
        </li>
        <li class="mobile-menu__item">
          <a href="./register.html" class="mobile-menu__link">
            <span class="nav-main-title">Sign Up</span>
            <span class="nav-sub-title">新規登録画面へ</span>
          </a>
        </li>
      </ul>
      <div class="mobile-menu__logo">
        <img src="./img/logo2.png" alt="logo2 image" />
      </div>
      <div class="mobile-menu__sns">各種logoが入ります</div>
    </nav>
  </div>
</body>

</html>