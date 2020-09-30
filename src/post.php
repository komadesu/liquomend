<?php
session_start();

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];


if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];

  $upload_error = $errors['upload'];
  $name_error = $errors['name'];
  $default_base_error = $errors['default_base'];
  $ingredients_and_quantities_error = $errors['ingredients_and_quantities'];
  $order_error = $errors['order'];
  $memo_error = $errors['memo'];
  $image_path_error = $errors['$image_path'];
  $server_error = $errors['$server'];
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

      <form action="./controller/post.php" method="POST" enctype="multipart/form-data">
        <div class="hero">
          <div class="hero__logo">
            <img src="./img/logo.png" alt="header logo image" />
          </div>

          <?php
          if ($server_error) echo "<p style='color: red; text-align: center;'>大変申し訳ありませんが、サーバー側の問題で登録できませんでした<br>しばらく待ってからもう一度お試しください</p>";
          if ($destination_error) echo "<p style='color: red; text-align: center;'>何らかの理由で画像がアップロードできませんでした、もう一度お試しください</p>";
          if ($upload_error) echo "<p style='color: red; text-align: center;'>画像を選択してください</p>";
          ?>
          <label class="recipe-img">
            <div class="recipe-img__bg-img">
              <img src="./img/hero.jpg" alt="recipe bg image" />
            </div>
            <div class="preview">
            </div>
            <div class="recipe-img__circle">
              <i class="fas fa-camera"></i>
            </div>
            <input type="file" name="recipe_image" class="recipe-img__input js-recipe-img-input" accept="image/*" />
          </label>
        </div>

        <?php if ($name_error) echo "<p style='color: red; text-align: center;'>レシピ名を入力してください</p>"; ?>
        <div class="recipe-name">
          <div class="container">
            <div class="row">
              <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <h3 class="recipe-name__title">
                  <input type="text" placeholder="レシピ名" name="recipe_name" value="<?php echo $name; ?>" class="recipe-name__input" />
                </h3>
              </div>
            </div>
          </div>
        </div>

        <div class="recipe-info">
          <?php if ($default_base_error) echo "<p style='color: red; text-align: center;'>お酒のベースを入力してください</p>"; ?>
          <div class="container">
            <div class="row">
              <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="form-group">
                  <label class="control-label">ベース</label>
                  <div class="select-wrap select-base">
                    <select name="recipe_base" value="<?php echo $default_base; ?>" class="js-base">
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
              <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="form-group">
                  <label class="control-label">度数</label>
                  <div class="select-wrap select-alcohol">
                    <select name="accurate_recipe_base" id="">
                      <option value="<?php echo $default_base; ?>"><?php echo $default_base ? $default_base : 'リキュール'; ?></option>
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
              <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="form-group">
                  <label class="control-label">度数</label>
                  <div class="select-wrap select-alcohol">
                    <select name="recipe_strength" id="">
                      <option value="<?php echo $strength; ?>"><?php echo $strength ? $strength : '度数'; ?></option>
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

        <?php if ($ingredients_and_quantities_error || $order_error) echo "<p style='color: red; text-align: center;'>材料と分量を対応させ、入力してください</p>"; ?>
        <div class="recipe-method container">
          <h4 class="recipe-method__title main-title">材料・分量</h4>
          <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 js-recipe-method">

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

        <?php if ($memo_error) echo "<p style='color: red; text-align: center;'>メモを書いて良さを伝えましょう！</p>"; ?>
        <div class="recipe-memo">
          <div class="container">
            <div class="row">
              <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                <div class="recipe-memo-inner">
                  <label for="memo" class="recipe-memo__title main-title">メモ</label>
                  <div class="recipe-memo__description">
                    <textarea id="memo" placeholder="銘柄、飲みやすさなど" name="recipe_memo" class="textarea"><?php echo $memo; ?></textarea>
                  </div>
                  <div class="recipe-memo__post">
                    <input type="submit" name="recipe_post_btn" value="投稿" class="post-btn" />
                  </div>
                </div>
              </div>
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
  <script src="./scripts/post.js" type="module"></script>
</body>

</html>