<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';

$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());

$sql = "select * from liquomend.drinks where type = 'usual' ;";
$result = pg_query($sql) or die('Query failed: ' . pg_last_error());



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Usual Menu</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/menu.css" />
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
          <p class="hero__search-word__string">定番メニュー</p>
          <div class="hero__search-word__underbar">
            <img src="./img/category-underbar.png" alt="category bar image" />
          </div>
        </div>
        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
      </div>

      <div class="select-base">
        <div class="extract-outer">
          <select name="extract" id="extract" class="pulldown extract" placeholder="Base">
            <option class="extract__base" value="liquor">リキュール</option>
            <option class="extract__base" value="gin">ジン</option>
            <option class="extract__base" value="rum">ラム</option>
            <option class="extract__base" value="vodka">ウォッカ</option>
            <option class="extract__base" value="tequila">テキーラ</option>
            <option class="extract__base" value="other">その他</option>
            <option class="extract__base" value="all">All</option>
          </select>
        </div>
      </div>

      <div class="drinks">
        <div class="cocktail container">
          <ul class="cocktail__list">


            <?php
            while ($record = pg_fetch_row($result)) :

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
          echo '<img src="./img/${uicon}" alt="icon image">';
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
      <div class="mobile-menu__sns">各種logoが入ります</div>
    </nav>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="./scripts/pulldown.js"></script>
  <script src="./scripts/extract.js"></script>
</body>

</html>