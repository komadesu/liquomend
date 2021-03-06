<?php
session_start();

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];



if (isset($_SESSION['base'])) {
  $base = $_SESSION['base'];
}
if (isset($_SESSION['all_drinks'])) {
  $all_drinks = $_SESSION['all_drinks'];
}


?>




<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Customize Menu</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/customize-menu.css" />
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
          echo "<option class='extract__base' value='other_liquor'>その他</option>";
          echo "<option class='extract__base' value='liquor'>定番</option>";
          echo "<option class='extract__base' value='all'>All</option>";
          echo "</select>";
          echo "</div>";
        else :
          echo '<p style="color: white; margin-bottom: 0; line-height: 60px;">いろんな飲み方を楽しんでみてね！</p>';
        endif;
        ?>


      </div>



      <div class="drinks">
        <div class="cocktail container">
          <div class="btn-outer">
            <a href="./controller/category.php" class="btn__back">カテゴリー選択へ戻る</a>
          </div>
          <ul class="cocktail__list">
            <div class="row">


              <?php
              foreach ($all_drinks as $drink) {

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
              ?>

            </div>
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

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="./scripts/pulldown.js"></script>
  <script src="./scripts/extract.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="./scripts/main.js" type="module"></script>
</body>

</html>