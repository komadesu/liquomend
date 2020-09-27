<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';
require './utils/index.php';

$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];


$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());

if ($_REQUEST['search']) {
  if ($_REQUEST['str']) {
    $search_word = h($_REQUEST['str']);

    $sql = "select * from liquomend.drinks where name like '%${search_word}%'  ;";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  } else {
    $message = '検索ワードを入力してください';
  }
} else {
  $message = '不正なアクセスです';
}





?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Search</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/search.css" />
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
          <img src="./img/logo.png" alt="header logo image">
        </div>
        <div class="hero__search-word">
          <p class="hero__search-word__string"><?php echo $search_word ? $search_word : '未入力'; ?></p>
          <div class="hero__search-word__underbar">
            <img src="./img/category-underbar.png" alt="category bar image">
          </div>
        </div>
        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
      </div>
      <div class="drinks">
        <div class="cocktail container">
          <ul class="cocktail__list">
            <div class="row">


              <?php
              if ($result) {
                while ($record = pg_fetch_row($result)) :

                  $id_d = $record[0];
                  $name = $record[2];
                  $base = $record[3];
                  $image = $record[6];

                  echo "<div class='col-4 col-md-2'>";
                  echo "<li class='cocktail__item ${base}'>";
                  echo "<a href='./detail.php?id_d=${id_d}' class='cocktail__link'>";
                  echo "<img src='./${image}' alt='drink image' class='cocktail__img' />";
                  echo "<div class='cocktail__description'>";
                  echo "<h5 class='cocktail__title text-truncate'>${name}</h5>";
                  echo "<p class='cocktail__text text-truncate'>${base}</p>";
                  echo "</div>";
                  echo "</a>";
                  echo "</li>";
                  echo "</div>";
                endwhile;
              } else {
                echo "<p style='height: 200px; line-height: 200px; margin: 0 auto; color: red; font-size: 1.6em;'>${message}</p>";
              }
              ?>

            </div>
          </ul>
        </div>
      </div>
      <div class="search">
        <div class="search-inner">
          <h3 class="search__title main-title">レシピ検索</h3>
          <form action="./search.php" method="GET" class="search__form">
            <div class="search__bar">
              <input type="text" placeholder="検索" name="str" class="search__input" />
              <button type="submit" name="search" value="search" class="search__btn">
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