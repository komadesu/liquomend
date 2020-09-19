<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | My Page</title>
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
          <div class="usericon">
            <img src="./img/sampleDrink.jpg" alt="user image" />
          </div>
          <p class="username">User Name</p>
        </div>
        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
      </div>

      <div class="container">
        <div class="edit-profile__form">
          <h3 class="form__title">Edit Profile</h3>
          <form action="edit.php" method="POST" class="form">
            <label for="email" class="form__label">Email</label>
            <input id="email" type="email" name="email" class="form__email mb-2" />
            <br />

            <label for="new-email" class="form__label">新しいEmail</label>
            <input id="new-email" type="email" name="new_email" class="form__email mb-2" />
            <br />

            <label for="password" class="form__label">パスワード</label>
            <input id="password" type="password" name="password" class="form__password mb-2" />
            <br />

            <label for="new-password" class="form__label">新しいパスワード</label>
            <input id="new-password" type="password" name="new_password" class="form__password mb-2" />
            <br />

            <label for="new-password-confirm" class="form__label">新しいパスワード(確認用)</label>
            <input id="new-password-confirm" type="password" name="password_confirm" class="form__password mb-4" />
            <br />

            <input type="submit" value="更新" class="form__btn" />
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
            <span class="nav-sub-title">ホームページ</span>
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
          <a href="./register.html" class="mobile-menu__link">
            <span class="nav-main-title">Sign Up</span>
            <span class="nav-sub-title">新規登録</span>
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