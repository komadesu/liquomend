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
  <title>Liquomend | Category</title>
  <link rel="stylesheet" href="./css/category.css" />
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
        <div class="hero__search-word">
          <p class="hero__search-word__string">Categories</p>
          <div class="hero__search-word__underbar">
            <img src="./img/category-underbar.png" alt="category bar image" />
          </div>
        </div>
        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
        <p class="category__description">ベースを選んでください。</p>
      </div>

      <div class="category">
        <ul class="category__list">
          <li class="category__base"><a href="./controller/customize_menu.php?base=liquor" class="category__link">リキュール</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=jin" class="category__link">ジン</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=wodka" class="category__link">ウォッカ</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=rum" class="category__link">ラム</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=tequila" class="category__link">テキーラ</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=whisky" class="category__link">ウイスキー</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=beer" class="category__link">ビール</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=shochu" class="category__link">焼酎</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=wine" class="category__link">ワイン</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=brandy" class="category__link">ブランデー</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=sake" class="category__link">日本酒</a></li>
          <li class="category__base"><a href="./controller/customize_menu.php?base=other" class="category__link">その他</a></li>
        </ul>
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