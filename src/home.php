<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

echo '<pre>';
echo var_dump(session_save_path());
echo dirname($_SERVER['DOCUMENT_ROOT']);
echo '</pre>';

require '../../../secret.php';
require './utils.php';


if (isset($_SESSION['user_id'])) {
  $id_u = $_SESSION['user_id'];
}
if (isset($_SESSION['user_name'])) {
  $uname = $_SESSION['user_name'];
}
if (isset($_SESSION['email_string'])) {
  $email = $_SESSION['email_string'];
}
if (isset($_SESSION['hash_password'])) {
  $hpw = $_SESSION['hash_password'];
}


echo var_dump($email);
echo var_dump($hpw);

$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());

if (isset($email) || isset($hpw)) {
  $sql = "select * from liquomend.users where email = '$email' ;";
  $result = pg_query($sql) or die('query failed: ' . pg_last_error());

  if (pg_num_rows($result)) {
    $row = pg_fetch_row($result);
    $id_u = $row[0];
    $uname = $row[1];
    $uicon = $row[4];
  }

  $_SESSION['user_id'] = $id_u;
  $_SESSION['user_name'] = $uname;
  $_SESSION['user_icon'] = $uicon;
}

$sql = "select * from liquomend.drinks where type = 'customize' limit 3 ;";
$recommend_result = pg_query($sql) or die('Query failed: ' . pg_last_error());

$sql = "select * from liquomend.drinks where type = 'usual' limit 3 ;";
$classic_result = pg_query($sql) or die('Query failed: ' . pg_last_error());




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
          <li class="nav__item"><a href="./usual-menu.php" class="nav__link">定番</a></li>
          <li class="nav__item"><a href="./mypage.php" class="nav__link">マイページ</a></li>
          <li class="nav__item"><a href="./post.php" class="nav__link">投稿</a></li>
        </ul>
      </nav>
      <div class="recommend">
        <h3 class="recommend__title main-title">Recommend Recipe</h3>
        <div class="cocktail container">
          <ul class="cocktail__list">


            <?php
            while ($record = pg_fetch_row($recommend_result)) :

              $id_d = $record[0];
              $name = $record[2];
              $base = $record[3];
              $image = $record[6];

              echo "<li class='cocktail__item ${base}'>";
              echo "<a href='./detail.php?id_d=${id_d}' class='cocktail__link'>";
              echo "<img src='./${image}' alt='drink image' class='cocktail__img' />";
              echo "<div class='cocktail__description'>";
              echo "<h5 class='cocktail__title'>${name}</h5>";
              echo "<p class='cocktail__text'>${base}</p>";
              echo "</div>";
              echo "</a>";
              echo "</li>";
            endwhile;
            ?>


          </ul>
        </div>
      </div>
      <div class="classic">
        <h3 class="classic__title main-title">定番ドリンク</h3>
        <div class="cocktail container">
          <ul class="cocktail__list">


            <?php
            while ($record = pg_fetch_row($classic_result)) :

              $id_d = $record[0];
              $name = $record[2];
              $base = $record[3];
              $image = $record[6];

              echo "<li class='cocktail__item ${base}'>";
              echo "<a href='./detail.php?id_d=${id_d}' class='cocktail__link'>";
              echo "<img src='./${image}' alt='drink image' class='cocktail__img' />";
              echo "<div class='cocktail__description'>";
              echo "<h5 class='cocktail__title'>${name}</h5>";
              echo "<p class='cocktail__text'>${base}</p>";
              echo "</div>";
              echo "</a>";
              echo "</li>";
            endwhile;
            ?>


          </ul>
          <div class="more-btn">
            <a href="./usual-menu.php">+ MORE</a>
          </div>
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
          echo "<div class='mobile-menu__username'>ユーザー</div>";
        } else {
          echo "<div class='mobile-menu__username'>$uname</div>";
        }

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
        <img src="./img/logo2.png" alt="logo2 image" onclick="location.href = './about.php'">
      </div>
      <div class="mobile-menu__sns">
        <a href="https://www.facebook.com/Liquomend" class="fb_icon icon"><img src="./img/facebook.png" alt="Facebook" /></a>
        <a href="https://www.instagram.com/liquomend" class="ig_icon icon"><img src="./img/instagram.png" alt="Instagram" /></a>
        <a href="" class="tw_icon icon"><img src="./img/twitter.png" alt="Twitter" /></a>
      </div>
    </nav>
  </div>
</body>

</html>