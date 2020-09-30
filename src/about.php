<?php
session_start();


$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];



?>


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
              <span class="creator__member">Mitsuki Habaki</span>
              <span class="creator__member">Runa Hino</span>
              <span class="creator__member">Kurea Honda</span>
            </div>
            <div class="creator-right">
              <span class="creator__member">システム担当</span>
              <span class="creator__member">デザイン・動画担当</span>
              <span class="creator__member">資料担当</span>
              <span class="creator__member">データ担当</span>
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
          <a href="https://www.facebook.com/Liquomend" class="fb_icon icon"><img src="./img/facebook-about.png" alt="Facebook" /></a>
          <a href="https://www.instagram.com/liquomend" class="ig_icon icon"><img src="./img/instagram-about.png" alt="Instagram" /></a>
          <a href="https://twitter.com/@liqumend" class="tw_icon icon"><img src="./img/twitter-about.png" alt="Twitter" /></a>
        </div>

        <div class="contact__logo">
          <img src="./img/logo2.png" alt="logo image" onclick="location.href = './controller/home.php'" />
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
          <img src="./img/logo2.png" alt="logo2 image" onclick="location.href='./home.php' ;" />
        </div>
        <div class="mobile-menu__sns">
          <a href="https://www.facebook.com/Liquomend" class="fb_icon icon"><img src="./img/facebook.png" alt="Facebook" /></a>
          <a href="https://www.instagram.com/liquomend" class="ig_icon icon"><img src="./img/instagram.png" alt="Instagram" /></a>
          <a href="https://twitter.com/@liqumend" class="tw_icon icon"><img src="./img/twitter.png" alt="Twitter" /></a>
        </div>
      </div>
    </nav>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="./scripts/main.js" type="module"></script>
</body>

</html>