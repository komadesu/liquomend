<?php
session_start();

ini_set('display_errors', 1);

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

$uicon = $_SESSION['user_icon'];


if (isset($_SESSION['your_drinks'])) {
  $your_drinks = $_SESSION['your_drinks'];
}
if (isset($_SESSION['your_favorite_drinks'])) {
  $your_favorite_drinks = $_SESSION['your_favorite_drinks'];
}



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | My Page</title>
  <link rel="stylesheet" href="./css/mypage.css" />
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

        <div class="mypage__hero">
          <?php

          echo "<div class='usericon js-usericon'>";

          if (!$uicon) {
            echo "<img src='./img/default-icon.svg' alt='user icon image' class='default circle js-usericon-btn' />";
          } else {
            echo "<img src='./${uicon}' alt='user icon image' class='circle js-usericon-btn' >";
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


      <nav class="nav">
        <ul class="nav__list">
          <!-- <li class="nav__item"><a href="#" class="nav__link js-nav__link js-nav-user">ユーザー情報</a></li> 後々これつけて、マイページの顔にする -->
          <li class="nav__item"><a href="#" class="nav__link js-nav__link js-nav-recipe">マイレシピ</a></li>
          <li class="nav__item"><a href="#" class="nav__link js-nav__link js-nav-favo">お気に入り</a></li>
          <li class="nav__item"><a href="#" class="nav__link js-nav__link js-nav-settings">設定</a></li>
        </ul>
      </nav>

      <div class="drinks js-target js-target-recipe active">
        <div class="cocktail container">
          <ul class="cocktail__list">
            <div class="row">



              <?php
              if (!empty($your_drinks)) :
                foreach ($your_drinks as $drink) {

                  $id_d = $drink[0];
                  $name = $drink[2];
                  $base = $drink[3];
                  $image = $drink[6];

                  echo "<div class='col-4 col-md-2'>";
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
              else :
                echo '<p>投稿がまだありません</p>';
              endif;
              ?>


            </div>
          </ul>
        </div>
        <div class="recipe-btn">
          <a href="./controller/post.php" class="link">
            <img src="./img/pen.png" alt="pen image" />
            <span>レシピを<br />書く</span>
          </a>
        </div>
      </div>

      <div class="drinks js-target js-target-favo inactive">
        <div class="cocktail container">
          <ul class="cocktail__list">
            <div class="row">



              <?php
              if (!empty($your_favorite_drinks)) :
                foreach ($your_favorite_drinks as $drink) {

                  $id_d = $drink[0];
                  $name = $drink[2];
                  $base = $drink[3];
                  $image = $drink[6];

                  echo "<div class='col-4 col-md-2'>";
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
              else :
                echo '<p>お気に入りが登録されていません</p>';
              endif;
              ?>


            </div>
          </ul>
        </div>
        <div class="recipe-btn">
          <a href="./controller/post.php" class="link">
            <img src="./img/pen.png" alt="pen image" />
            <span>レシピを<br />書く</span>
          </a>
        </div>
      </div>

      <div class="settings js-target js-target-settings inactive">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <ul class="settings__list">
                <li class="item"><a href="./controller/edit_profile.php" class="link">パスワード変更</a></li>
              </ul>
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
            <a href="./controller/category.php" class="mobile-menu__link">
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
            <a href="./controller/about.php" class="mobile-menu__link">
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
          <img src="./img/logo2.png" alt="logo2 image" onclick="location.href='./controller/about.php' ;" />
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
  <script src="./scripts/mypage.js" type="module"></script>
</body>

</html>