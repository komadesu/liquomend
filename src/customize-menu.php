<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';
require './utils.php';

$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

$base = h($_REQUEST['base']);


$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
or die('Could not connect: ' . pg_last_error());

if ($base === 'liquor') {
  $sql = "select * from liquomend.drinks where base in ('peach', 'cassis', 'kahlua', 'malibu', 'dita', 'other_liquor') and type = 'customize' ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
} else {
  $sql = "select * from liquomend.drinks where base = '$base' and type = 'customize' ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
}



?>




<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Customize Menu</title>
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
          <p class="hero__search-word__string"><?php echo $base; ?></p>
          <div class="hero__search-word__underbar">
            <img src="./img/category-underbar.png" alt="category bar image" />
          </div>
        </div>
        <div class="hero__bg-img">
          <img src="./img/hero.jpg" alt="hero image" />
        </div>
      </div>

      <div class="select-base">


        <?php

        if ($base === 'liquor') :
          echo "<div class='extract-outer'>";
          echo "<select name='extract' id='extract' class='pulldown extract' placeholder='Base'>";
          echo "<option class='extract__base' value='peach'>ピーチ</option>";
          echo "<option class='extract__base' value='cassis'>カシス</option>";
          echo "<option class='extract__base' value='kahlua'>カルーア</option>";
          echo "<option class='extract__base' value='malibu'>マリブ</option>";
          echo "<option class='extract__base' value='dita'>ディタ</option>";
          echo "<option class='extract__base' value='other'>その他</option>";
          echo "<option class='extract__base' value='all'>All</option>";
          echo "</select>";
          echo "</div>";
        else :
          echo '<p style="color: white; margin-bottom: 0; line-height: 60px;">いろんな飲み方を楽しんでみてね！</p>';
        endif;
        ?>

        <!-- <div class="sort-outer">
          <form class="sort-form" action="#" method="POST">
            <select name="sort" id="sort" class="pulldown sort" placeholder="Sort">
              <option class="sort__item" value="new">最新順</option>
              <option class="sort__item" value="good">いいね数</option>
            </select>
          </form>
        </div> -->
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
      <div class="mobile-menu__sns">各種logoが入ります</div>
    </nav>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="./scripts/pulldown.js"></script>
  <script src="./scripts/extract.js"></script>
</body>

</html>