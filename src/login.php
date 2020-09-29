<?php
session_start();

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


if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
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

              <form action="./controller/login_user.php" method="POST" class="form">
                <label for="email" class="form__label">Email</label>
                <input id="email" type="email" name="email" value="<?php echo $email; ?>" class="form__email mb-2" />
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
                  echo '<p style="color: red;">入力漏れがあります</p>';
                }
                if ($id) {
                  echo '<p style="color: red;">このメールアドレスは登録されていません</p>';
                }
                if ($confirm) {
                  echo '<p style="color: red;">パスワードが間違っています</p>';
                }

                session_destroy();
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
          echo "<div class='mobile-menu__username'><a href='./controller/mypage.php'>ユーザー</a></div>";
        } else {
          echo "<div class='mobile-menu__username'><a href='./controller/mypage.php'>$uname</a></div>";
        }

        ?>



      </div>
      <div class="mobile-menu__body">
        <ul class="mobile-menu__main">
          <li class="mobile-menu__item">
            <a href="./controller/home.php" class="mobile-menu__link">
              <span class="nav-main-title">Home</span>
              <span class="nav-sub-title">ホーム</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./controller/mypage.php" class="mobile-menu__link">
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
            <a href="./controller/mypage.php?component=favorite" class="mobile-menu__link">
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
            <a href="./controller/mypage.php?component=settings" class="mobile-menu__link">
              <span class="nav-main-title">Settings</span>
              <span class="nav-sub-title">設定</span>
            </a>
          </li>
          <li class="mobile-menu__item">
            <a href="./controller/post.php" class="mobile-menu__link">
              <span class="nav-main-title">Post</span>
              <span class="nav-sub-title">レシピ投稿</span>
            </a>
          </li>
        </ul>
        <div class="mobile-menu__logo">
          <img src="./img/logo2.png" alt="logo2 image" onclick="location.href='./about.php' ;" />
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