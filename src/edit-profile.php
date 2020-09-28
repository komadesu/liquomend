<?php
session_start();

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

if (!isset($id_u)) {
  header('location: ./login.php');
  exit;
}


if (isset($_SESSION['errors']['empty'])) {
  $error_empty = $_SESSION['errors']['empty'];
} else {
  $error_empty = null;
}
if (isset($_SESSION['errors']['confirm'])) {
  $error_confirm = $_SESSION['errors']['confirm'];
} else {
  $error_confirm = null;
}
if (isset($_SESSION['errors']['password'])) {
  $error_password = $_SESSION['errors']['password'];
} else {
  $error_password = null;
}
if (isset($_SESSION['errors']['match'])) {
  $error_match = $_SESSION['errors']['match'];
} else {
  $error_match = null;
}
if (isset($_SESSION['errors']['access'])) {
  $error_access = $_SESSION['errors']['access'];
} else {
  $error_access = null;
}
if (isset($_SESSION['good'])) {
  $good = $_SESSION['good'];
} else {
  $good = null;
}



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Edit Profile</title>
  <link rel="stylesheet" href="./css/edit-profile.css" />
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
        <div class="hero__logo">
          <img src="./img/logo.png" alt="header logo image" />
        </div>

        <div class="edit-profile__hero">
          <?php

          echo "<div class='usericon'>";

          if (!$uicon) {
            echo "<img src='./img/default-icon.svg' alt='user icon image' />";
          } else {
            echo '<img src="./img/$uicon" alt="icon image">';
          }

          echo "</div>";

          if (!$uname) {
            echo "<p class='username'>User Name</p>";
          } else {
            echo "<p class='username'>$uname</p>";
          }
          ?>
        </div>

        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">

            <?php
            if ($good) {

              echo "<div class='container'>";
              echo "<div class='confirm'>";
              echo "<h3 class='form__title'>パスワード変更完了画面</h3>";

              echo "<label class='form__label'>Thanks!</label>";
              echo "<p class='control mb-4'>パスワード変更が完了しました</p>";

              echo "<a href='./home.php' style='display: block; text-align: right;'>ホームへ移動</a>";
              echo "</div>";
              echo "</div>";
            } else {


              echo "<div class='edit-profile__form'>";
              echo "<h3 class='form__title'>パスワード変更</h3>";

              echo "<p style='color: red; margin: 15px 0;'>";
              if ($error_empty) echo '全て入力してください';
              if ($error_confirm) echo 'このメールアドレスは登録されていません';
              if ($error_password) echo '現在のパスワードが間違っています';
              if ($error_match) echo '新しいパスワードと確認パスワードが一致しません';
              if ($error_access) echo '不正なアクセスです';
              echo "</p>";

              echo "<form action='./controller/edit_profile.php' method='POST' class='form'>";
              echo "<label for='email' class='form__label'>Email</label>";
              echo "<input id='email' type='email' name='email' value='$email' class='form__email mb-2' />";
              echo "<br />";

              echo "<label for='password' class='form__label'>パスワード</label>";
              echo "<input id='password' type='password' name='password' value='$pass' class='form__password mb-2' />";
              echo "<br />";

              echo "<label for='new-password' class='form__label'>新しいパスワード</label>";
              echo "<input id='new-password' type='password' name='new_password' value='$n_pass' class='form__password mb-2' />";
              echo "<br />";

              echo "<label for='new-password-confirm' class='form__label'>新しいパスワード(確認用)</label>";
              echo "<input id='new-password-confirm' type='password' name='confirm_password' value='$c_pass' class='form__password mb-4' />";
              echo "<br />";

              echo "<input type='submit' value='更新' name='update_password_btn' class='form__btn' />";
              echo "</form>";
              echo "</div>";
            }
            ?>
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
            <a href="./controller/usual_menu.php" class="mobile-menu__link">
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