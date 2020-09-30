<?php
session_start();

ini_set('display_errors', 1);

if (isset($_SESSION['user_id'])) {
  $id_u = $_SESSION['user_id'];
}
if (isset($_SESSION['user_name'])) {
  $uname = $_SESSION['user_name'];
}
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}
if (isset($_SESSION['user_icon'])) {
  $uicon = $_SESSION['user_icon'];
} else {
  $uicon = null;
}

if (isset($_SESSION['three_recommend_drinks']) && isset($_SESSION['three_usual_drinks'])) {
  if (isset($_SESSION['three_recommend_drinks'])) {
    $three_recommend_drinks = $_SESSION['three_recommend_drinks'];
  }
  if (isset($_SESSION['three_usual_drinks'])) {
    $three_usual_drinks = $_SESSION['three_usual_drinks'];
  }
} else {
  header('location: ./controller/home.php');
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Home</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/home.css" />
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
          <li class="nav__item"><a href="./controller/usual_menu.php" class="nav__link">定番</a></li>
          <li class="nav__item"><a href="./controller/mypage.php" class="nav__link">マイページ</a></li>
          <li class="nav__item"><a href="./controller/post.php" class="nav__link">投稿</a></li>
        </ul>
      </nav>
      <div class="recommend">
        <h3 class="recommend__title main-title">Recommend Recipe</h3>
        <div class="cocktail container">
          <ul class="cocktail__list">
            <div class="row">


              <?php
              $firstFlag = true;
              foreach ($three_recommend_drinks as $drink) {

                $id_d = $drink[0];
                $name = $drink[2];
                $base = $drink[3];
                $image = $drink[6];

                if ($firstFlag) {
                  echo "<div class='col-4 col-md-2 offset-md-3'>";
                  $firstFlag = false;
                } else {
                  echo "<div class='col-4 col-md-2'>";
                }
                echo "<li class='cocktail__item ${base}'>";
                echo "<a href='./controller/detail.php?id_d=${id_d}' class='cocktail__link'>";
                echo "<img src='./${image}' alt='drink image' class='cocktail__img' />";
                echo "<div class='cocktail__description'>";
                echo "<h5 class='cocktail__title text-truncate'>${name}</h5>";
                echo "<p class='cocktail__text text-truncate'>${base}</p>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
                echo "</div>";
              }
              ?>

            </div>
          </ul>
        </div>
      </div>
      <div class="classic">
        <h3 class="classic__title main-title">定番ドリンク</h3>
        <div class="cocktail container">
          <ul class="cocktail__list">
            <div class="row">


              <?php
              $firstFlag = true;
              foreach ($three_usual_drinks as $drink) {

                $id_d = $drink[0];
                $name = $drink[2];
                $base = $drink[3];
                $image = $drink[6];

                if ($firstFlag) {
                  echo "<div class='col-4 col-md-2 offset-md-3'>";
                  $firstFlag = false;
                } else {
                  echo "<div class='col-4 col-md-2'>";
                }
                echo "<li class='cocktail__item ${base}'>";
                echo "<a href='./controller/detail.php?id_d=${id_d}' class='cocktail__link'>";
                echo "<img src='./${image}' alt='drink image' class='cocktail__img' />";
                echo "<div class='cocktail__description'>";
                echo "<h5 class='cocktail__title text-truncate'>${name}</h5>";
                echo "<p class='cocktail__text text-truncate'>${base}</p>";
                echo "</div>";
                echo "</a>";
                echo "</li>";
                echo "</div>";
              }
              ?>

            </div>
          </ul>
          <div class="more-btn">
            <a href="./controller/usual_menu.php">+ MORE</a>
          </div>
        </div>
      </div>
      <div class="search">
        <div class="search-inner">
          <h3 class="search__title main-title">レシピ検索</h3>
          <form action="./controller/search.php" method="GET" class="search__form">
            <div class="search__bar">
              <input type="text" placeholder="検索" name="str" class="search__input" />
              <button type="submit" name="search_btn" value="search" class="search__btn">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
          <p class="search__info">またはカテゴリーから探すこともできます。</p>
          <div class="search__categories">
            <a href="./category.php" class="link">Categories</a>
          </div>
        </div>
        <div class="search__img">
          <img src="./img/bg.jpg" alt="search bg image" />
        </div>
      </div>
      <footer class="footer">
        <p class="footer__copyright"><small>&copy;gms.gdl.jp</small></p>
      </footer>
    </div>
    <nav class="mobile-menu">
      <div class="mobile-menu__profile">


        <?php

        echo '<div class="mobile-menu__icon js-mobile-menu__icon">';

        if (!$uicon) {
          echo '<img src="./img/default-icon.svg" alt="icon sample image" class="js-usericon-btn">';
        } else {
          echo  "<img src='./${uicon}' alt='icon image' class='js-usericon-btn'>";
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
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="./scripts/main.js" type="module"></script>
</body>

</html>