<?php

require '../../../secret.php';
require './utils.php';

session_start();
if (isset($_SESSION['uname'])) {
  $uname = $_SESSION['uname'];
}
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}
if (isset($_SESSION['hpw'])) {
  $hpw = $_SESSION['hpw'];
}

if (!isset($uname) || !isset($email) || !isset($hpw)) {
  header('location: ./login.php');
}
$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());

$sql = "select * from liquomend.user where email = '$email' ;";
$result = pg_query($sql) or die('query failed: ' . pg_last_error());
if (pg_num_rows($result)) {
  $row = pg_fetch_row($result);
  $uname = $row[1];
  $uicon = $row[4];
}

// 上記の $row 中身
// array(5) {
//   [0]=>
//   string(1) "5"
//   [1]=>
//   string(2) "hi"
//   [2]=>
//   string(14) "hi@example.com"
//   [3]=>
//   string(60) "$2y$10$UOE1V09K.Y.xfFKdcWTtgO7eI4mXVBEXHiOf8ts6nDGjwAEr006P6"
//   [4]=>
//   NULL
// }
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
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
          <li class="nav__item"><a href="#" class="nav__link">About</a></li>
        </ul>
      </nav>
      <div class="recommend">
        <h3 class="recommend__title main-title">Recommend Recipe</h3>
        <div class="cocktail container">
          <ul class="cocktail__list">
            <li class="cocktail__item">
              <a href="cocktail__link">
                <img src="./img/sampleDrink.jpg" alt="sample drink image" class="cocktail__img" />
                <div class="cocktail__description">
                  <h5 class="cocktail__title">カクテル名</h5>
                  <p class="cocktail__text">ベースリキュール</p>
                </div>
              </a>
            </li>
            <li class="cocktail__item">
              <a href="cocktail__link">
                <img src="./img/sampleDrink.jpg" alt="sample drink image" class="cocktail__img" />
                <div class="cocktail__description">
                  <h5 class="cocktail__title">カクテル名</h5>
                  <p class="cocktail__text">ベースリキュール</p>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="classic">
        <h3 class="classic__title main-title">定番ドリンク</h3>
        <div class="cocktail container">
          <ul class="cocktail__list">
            <li class="cocktail__item">
              <a href="cocktail__link">
                <img src="./img/sampleDrink.jpg" alt="sample drink image" class="cocktail__img" />
                <div class="cocktail__description">
                  <h5 class="cocktail__title">カクテル名</h5>
                  <p class="cocktail__text">ベースリキュール</p>
                </div>
              </a>
            </li>
          </ul>
          <div class="more-btn">
            <a href="./usual-menu.html">+ MORE</a>
          </div>
        </div>
      </div>
      <div class="search">
        <div class="search-inner">
          <h3 class="search__title main-title">レシピ検索</h3>
          <form action="#" method="GET" class="search__form">
            <div class="search__bar">
              <input type="text" placeholder="検索" class="search__input" />
              <button type="submit" class="search__btn">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
          <p class="search__info">またはカテゴリーから探すこともできます。</p>
          <div class="search__categories">Categories</div>
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

        echo "<div class='mobile-menu__username'>$uname</div>";

        ?>


      </div>
      <ul class="mobile-menu__main">
        <li class="mobile-menu__item">
          <a href="#" class="mobile-menu__link">
            <span class="nav-main-title">ページ</span>
            <span class="nav-sub-title">なんとかページ</span>
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
        <img src="./img/logo2.png" alt="logo2 image">
      </div>
      <div class="mobile-menu__sns">各種logoが入ります</div>
    </nav>
  </div>
</body>

</html>