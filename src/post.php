<?php
ini_set('session.save_path', realpath('./../session'));
session_start();

require '../../../secret.php';



if (isset($_POST['recipe_post'])) {


  $id_u = $_SESSION['user_id'];

  $name = $_POST['recipe_name'];
  $default_base = $_POST['recipe_base'];
  $accurate_base = $_POST['accurate_recipe_base'];
  $strength = $_POST['recipe_strength'];
  $ingredients = $_POST['recipe_ingredients'];
  $quantities = $_POST['recipe_quantities'];
  $memo = $_POST['recipe_memo'];





  $unique_id = uniqid(mt_rand(), true);

  $save_path = './upload_files/drinks/';
  $destination = $save_path . $unique_id . basename($_FILES['recipe_image']['name']);


  if (!empty($_FILES['recipe_image']['tmp_name']) && is_uploaded_file($_FILES['recipe_image']['tmp_name'])) {
    if (move_uploaded_file($_FILES['recipe_image']['tmp_name'], $destination)) {
      echo 'アップロードされたファイルを保存しました';
    } else {
      echo 'アップロードされたファイルの保存に失敗しました';
    };




    if (!$accurate_base) {
      $base = $default_base;
    } else {
      $base = $accurate_base;
    }

    echo '<pre>';
    echo var_dump($id_u, $name, $base, $strength, $memo, $destination);
    echo '</pre>';



    $dbconn = pg_connect("host=localhost dbname=$SQL_DB user=$SQL_USER password=$SQL_PASS")
      or die('Could not connect: ' . pg_last_error());



    $sql = "insert into liquomend.drinks
                (id_u, name, base, strength, memo, image, type)
            values
                ('$id_u', '$name', '$base', '$strength', '$memo', '$destination', 'customize');";

    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());



    $sql = "select id_d from liquomend.drinks where liquomend.drinks.id_u = '$id_u' and liquomend.drinks.image = '$destination' ; ";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

    if (pg_num_rows($result)) {
      $record = pg_fetch_row($result);

      $id_d = $record[0];
    }



    foreach ($ingredients as $ingredient) {
      if (!$ingredient) {
        break;
      }

      $sql = "insert into liquomend.ingredients (id_d, ingredient) values ('$id_d', '$ingredient');";
      $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
      echo var_dump($result);

      echo '<pre>';
      echo var_dump($ingredient);
      echo '</pre>';
    }


    // $sql = "select id_i from liquomend.ingredients where liquomend.ingredients.id_d = '$id_d' ;";
    // $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

    // if (pg_num_rows($result)) {

    //   while ($record = pg_fetch_row($result)) {

    //     foreach ($quantities as $quantity) {
    //       if (!$quantity) {
    //         break;
    //       }

    //       $sql = "insert into liquomend.quantities (id_d, quantity, id_i) values ('$id_d', '$quantity', '$id_i');";
    //       $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

    //       echo '<pre>';
    //       echo var_dump($result);
    //       echo '</pre>';
    //     }

    //     echo '<pre>';
    //     echo var_dump($record);
    //     echo '</pre>';
    //     $id_i = $record[0];


    //   }
    // }
  };
}




?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liquomend | Post</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/post.css" />
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

      <form action="./post.php" method="POST" enctype="multipart/form-data">
        <div class="hero">
          <div class="hero__logo">
            <img src="./img/logo.png" alt="header logo image" />
          </div>
          <label class="recipe-img">
            <div class="recipe-img__bg-img">
              <img src="./img/hero.jpg" alt="recipe bg image" />
            </div>
            <div class="preview">
            </div>
            <div class="recipe-img__circle">
              <i class="fas fa-camera"></i>
            </div>
            <input type="file" name="recipe_image" class="recipe-img__input js-recipe-img-input" accept="image/*" required />
          </label>
        </div>

        <div class="recipe-name">
          <h3 class="recipe-name__title">
            <input type="text" placeholder="レシピ名" name="recipe_name" class="recipe-name__input" />
          </h3>
        </div>

        <div class="recipe-info">
          <div class="container">
            <div class="row">
              <div class="col-10 offset-1">
                <div class="form-group">
                  <label class="control-label">ベース</label>
                  <div class="select-wrap select-base">
                    <select name="recipe_base" class="js-base">
                      <option value="">ベース</option>
                      <option class="recipe-info__base" value="liquor">リキュール</option>
                      <option class="recipe-info__base" value="gin">ジン</option>
                      <option class="recipe-info__base" value="vodka">ウォッカ</option>
                      <option class="recipe-info__base" value="rum">ラム</option>
                      <option class="recipe-info__base" value="tequila">テキーラ</option>
                      <option class="recipe-info__base" value="whisky">ウイスキー</option>
                      <option class="recipe-info__base" value="beer">ビール</option>
                      <option class="recipe-info__base" value="shochu">焼酎</option>
                      <option class="recipe-info__base" value="wine">ワイン</option>
                      <option class="recipe-info__base" value="brandy">ブランデー</option>
                      <option class="recipe-info__base" value="sake">日本酒</option>
                      <option class="recipe-info__base" value="other">その他</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row js-toggle inactive">
              <div class="col-10 offset-1">
                <div class="form-group">
                  <label class="control-label">度数</label>
                  <div class="select-wrap select-alcohol">
                    <select name="accurate_recipe_base" id="">
                      <option value="">リキュール</option>
                      <option class="recipe-info__liquor" value="cassis">カシス</option>
                      <option class="recipe-info__liquor" value="peach">ピーチ</option>
                      <option class="recipe-info__liquor" value="malibu">マリブ</option>
                      <option class="recipe-info__liquor" value="kahlua">カルーア</option>
                      <option class="recipe-info__liquor" value="rum">ラム</option>
                      <option class="recipe-info__liquor" value="campari">カンパリ</option>
                      <option class="recipe-info__liquor" value="tiffin">ティフィン</option>
                      <option class="recipe-info__liquor" value="cointreau">コアントロー</option>
                      <option class="recipe-info__liquor" value="other">その他</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-10 offset-1">
                <div class="form-group">
                  <label class="control-label">度数</label>
                  <div class="select-wrap select-alcohol">
                    <select name="recipe_strength" id="">
                      <option value="">度数</option>
                      <option value="10" class="recipe-info__alcohole">10</option>
                      <option value="20" class="recipe-info__alcohole">20</option>
                      <option value="30" class="recipe-info__alcohole">30</option>
                      <option value="40" class="recipe-info__alcohole">40</option>
                      <option value="50" class="recipe-info__alcohole">50</option>
                      <option value="60" class="recipe-info__alcohole">60</option>
                      <option value="70" class="recipe-info__alcohole">70</option>
                      <option value="80" class="recipe-info__alcohole">80</option>
                      <option value="90" class="recipe-info__alcohole">90</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="recipe-method container">
          <h4 class="recipe-method__title main-title">材料・分量</h4>
          <div class="row">
            <div class="col-12 js-recipe-method">
              <div class="form-group js-recipe-method-item" id="1">
                <div class="input">
                  <label for="ingredient" class="recipe-method__label">材料１</label>
                  <input type="text" id="ingredient" name="recipe_ingredients[]" class="recipe-method__input" />
                </div>
                <div class="input">
                  <label for="quantity" class="recipe-method__label">分量１</label>
                  <input type="text" id="quantity" name="recipe_quantities[]" class="recipe-method__input" />
                </div>
                <div class="recipe-method__delete js-delete-btn">
                  <p>削除</p>
                </div>
              </div>
              <div class="form-group js-recipe-method-item" id="2">
                <div class="input">
                  <label for="ingredient" class="recipe-method__label">材料２</label>
                  <input type="text" id="ingredient" name="recipe_ingredients[]" class="recipe-method__input" />
                </div>
                <div class="input">
                  <label for="quantity" class="recipe-method__label">分量２</label>
                  <input type="text" id="quantity" name="recipe_quantities[]" class="recipe-method__input" />
                </div>
                <div class="recipe-method__delete js-delete-btn">
                  <p>削除</p>
                </div>
              </div>
              <div class="form-group js-recipe-method-item" id="3">
                <div class="input">
                  <label for="ingredient" class="recipe-method__label">材料３</label>
                  <input type="text" id="ingredient" name="recipe_ingredients[]" class="recipe-method__input" />
                </div>
                <div class="input">
                  <label for="quantity" class="recipe-method__label">分量３</label>
                  <input type="text" id="quantity" name="recipe_quantities[]" class="recipe-method__input" />
                </div>
                <div class="recipe-method__delete js-delete-btn">
                  <p>削除</p>
                </div>
              </div>
            </div>
          </div>
          <div class="add js-add-btn">
            <span class="add-btn">+材料・分量を追加</span>
          </div>
        </div>

        <div class="recipe-memo">
          <div class="recipe-memo-inner">
            <h3 class="recipe-memo__title main-title">メモ</h3>
            <div class="recipe-memo__description">
              <textarea id="" cols="30" rows="4" placeholder="銘柄、飲みやすさなど" name="recipe_memo" class="textarea"></textarea>
            </div>
            <div class="recipe-memo__post">
              <input type="submit" value="投稿" name="recipe_post" class="post-btn" />
            </div>
          </div>
          <div class="recipe-memo__img">
            <img src="./img/bg.jpg" alt="recipe-memo bg image" />
          </div>
        </div>
      </form>

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
  <script src="./scripts/main.js" type="module"></script>
</body>

</html>