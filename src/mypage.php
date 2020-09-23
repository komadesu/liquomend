<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';
require './utils.php';

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];


if (!$id_u) {
  header('location: ./login.php');
  exit;
}




$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());

$sql = "select * from liquomend.drinks where id_u = '$id_u' ;";
$recipe_result = pg_query($sql) or die('Query failed: ' . pg_last_error());

$sql = "select * from liquomend.drinks where id_u = '$id_u' ;"; // お気に入り機能実装時に要編集
$favo_result = pg_query($sql) or die('Query failed: ' . pg_last_error());



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

          echo "<div class='usericon'>";

          if (!$uicon) {
            echo "<img src='./img/default-icon.svg' alt='user icon image' />";
          } else {
            echo '<img src="./img/$uicon" alt="icon image">';
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
              if (pg_num_rows($recipe_result)) :
                while ($record = pg_fetch_row($recipe_result)) :

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
              endif;
              ?>


            </div>
          </ul>
        </div>
        <div class="recipe-btn">
          <a href="./post.html" class="link">
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
              if (pg_num_rows($favo_result)) :
                while ($record = pg_fetch_row($favo_result)) :

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
              endif;
              ?>


            </div>
          </ul>
        </div>
        <div class="recipe-btn">
          <a href="./post.html" class="link">
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
                <li class="item"><a href="./settings.html" class="link">プロフィール編集</a></li>
                <li class="item"><a href="./settings.html" class="link">プロフィール編集</a></li>
                <li class="item"><a href="./settings.html" class="link">プロフィール編集</a></li>
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
      <div class="mobile-menu__sns">
        <a href="https://www.facebook.com/Liquomend" class="fb_icon icon"><img src="./img/facebook.png" alt="Facebook" /></a>
        <a href="https://www.instagram.com/liquomend" class="ig_icon icon"><img src="./img/instagram.png" alt="Instagram" /></a>
        <a href="" class="tw_icon icon"><img src="./img/twitter.png" alt="Twitter" /></a>
      </div>
    </nav>
  </div>

  <script src="./scripts/mypage-nav.js"></script>
</body>

</html>