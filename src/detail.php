<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';
require './utils.php';

$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

$id_d = h($_REQUEST['id_d']);

$dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
  or die('Could not connect: ' . pg_last_error());

$sql = "select * from liquomend.drinks where id_d = '$id_d' ;";
$drink_result = pg_query($sql) or die('Query failed: ' . pg_last_error());

if (pg_num_rows($drink_result)) {
  $record = pg_fetch_row($drink_result);

  $name = $record[2];
  $image = $record[6];
  $memo = $record[5];
}


$sql = "select liquomend.ingredients.ingredient, liquomend.quantities.quantity from liquomend.drinks inner join liquomend.ingredients on liquomend.drinks.id_d = liquomend.ingredients.id_d inner join liquomend.quantities on liquomend.drinks.id_d = liquomend.quantities.id_d and liquomend.ingredients.id_i = liquomend.quantities.id_i where liquomend.drinks.id_d = $id_d ;";
$detail_drink_result = pg_query($sql) or die('Query failed: ' . pg_last_error());



$sql = "select * from liquomend.drinks where type = 'customize' limit 3 ;";
$recipe_result = pg_query($sql) or die('Query failed: ' . pg_last_error());



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Detail</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/detail.css" />
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
      <div class="detail__logo">
        <img src="./img/logo.png" alt="detail logo image" />
      </div>

      <div class="detail__name">
        <p class="string"><?php echo $name; ?></p>
        <div class="underbar">
          <img src="./img/category-underbar.png" alt="category bar image" />
        </div>
      </div>

      <div class="container">
        <div class="detail__image">
          <img src="./<?php echo $image; ?>" alt="detail drink image" />
        </div>
      </div>

      <div class="detail__method">
        <div class="container">
          <div class="row">
            <div class="col-10 offset-1">
              <div class="detail__method-inner">
                <h4 class="title">材料・分量</h4>
                <div class="ingredients-and-quantity">


                  <?php
                  if (pg_num_rows($detail_drink_result)) {
                    while ($row = pg_fetch_row($detail_drink_result)) {

                      $ingredient = $row[0];
                      $quantity = $row[1];

                      echo "<div class='item'><span class='ingredient'>${ingredient}</span><span class='quantity'>${quantity}</span></div>";
                    }
                  }
                  ?>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="detail__memo">
        <div class="container">
          <div class="row">
            <div class="col-10 offset-1">
              <h5 class="title main-title">メモ</h5>
              <p class="content"><?php echo $memo; ?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="detail__share">
        <a href="./post.html" class="share-btn">レシピを共有</a>
      </div>

      <div class="detail__related-base-recipe">
        <h5 class="title main-title">みんなのレシピ</h5>
        <h6 class="sub-title">同じお酒のみんなのレシピ</h6>

        <div class="cocktail container">
          <ul class="cocktail__list">


            <?php
            while ($record = pg_fetch_row($recipe_result)) :

              $id_d = $record[0];
              $name = $record[2];
              $base = $record[3];
              $image = $record[6];

              echo "<li class='cocktail__item ${base}'>";
              echo "<a href='./detail.php?id=${id_d}' class='cocktail__link'>";
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
            <a href="./customize-menu.php">+ MORE</a>
          </div>
        </div>
      </div>

      <div class="detail__post">
        <div class="container">
          <div class="row">
            <div class="col-10 offset-1">
              <h5 class="title main-title">Post Your Recipe</h5>
              <a href="./post.php" class="write-btn">レシピを書く</a>
            </div>
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
</body>

</html>