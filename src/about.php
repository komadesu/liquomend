<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | About</title>
  <link rel="stylesheet" href="./css/about.css" />
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

      <div class="services">
        <h4 class="services__title main-title">Services</h4>
        <h5 class="services__sub-title">Discover Your Favorites</h5>
        <div class="services__words">
          <p class="services__catchcopy">
            大人の贅沢を堪能しよう。<br />
            お酒を嗜み、人生に華を添えよう。
          </p>
          <p class="services__description">
            あらゆる人が投稿したレシピと出会うことができます。<br />
            また、あなたのオリジナルレシピを投稿して世界中の人に知ってもらうこともできます。
          </p>
        </div>
      </div>
      <div class="creator">
        <div class="creator-inner">
          <h4 class="creator__title main-title">Creator</h4>
          <div class="creator__members">
            <div class="creator-left">
              <span class="creator__member">Koma Tsugata</span>
              <span class="creator__member">Kurea Honda</span>
              <span class="creator__member">Mamiko Matsuki</span>
              <span class="creator__member">Syunto Nakamura</span>
            </div>
            <div class="creator-right">
              <span class="creator__member">Mitsuki Habaki</span>
              <span class="creator__member">Runa Hino</span>
              <span class="creator__member">Tentaro Miyagi</span>
              <span class="creator__member">Yukiho Nishinarita</span>
            </div>
          </div>
        </div>
        <div class="creator__img">
          <img src="./img/bg.jpg" alt="creator bg image" />
        </div>
      </div>
      <div class="contact">
        <h4 class="contact__title main-title">Contact</h4>
        <p class="contact__email">E-mail：moon0903@gms.gdl.jp</p>
        <div class="contact__sns">
          <span class="contact__icon">icon</span>
          <span class="contact__icon">icon</span>
          <span class="contact__icon">icon</span>
        </div>
        <div class="contact__logo">
          <img src="./img/logo2.png" alt="logo image" />
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
          <a href="＃" class="mobile-menu__link">
            <span class="nav-main-title">ページ</span>
            <span class="nav-sub-title">なんとかページ</span>
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