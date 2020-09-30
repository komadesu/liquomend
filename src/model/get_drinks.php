<?php
require '../utils/connect.php';


function getDrinks($type, $limit, $base, $id_u)
{
  if ($id_u) {
    $sql = "select * from liquomend.drinks where id_u = '$id_u' ;";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
    $drinks = [];
    if (pg_num_rows($result)) {
      while ($drink = pg_fetch_row($result)) {
        array_push($drinks, $drink);
      }
    }

    return $drinks;
  } else {

    if ($base) {

      // controller/detail.php からの取得詳細ページの三つ出す場合
      if ($type && $limit) {

        if ($base === 'liquor') {
          $sql = "select * from liquomend.drinks where base in ('peach', 'cassis', 'kahlua', 'malibu', 'dita', 'other_liquor', 'liquor') and type = '$type' limit $limit ;";
          $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
          $drinks = [];
          if (pg_num_rows($result)) {
            while ($drink = pg_fetch_row($result)) {
              array_push($drinks, $drink);
            }
          }


          return $drinks;
        } else {

          $sql = "select * from liquomend.drinks where base = '$base' and type = '$type' limit $limit ;";
          $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
          $drinks = [];
          if (pg_num_rows($result)) {
            while ($drink = pg_fetch_row($result)) {
              array_push($drinks, $drink);
            }
          }


          return $drinks;
        }
      }

      // customize-menu.php において、元々は customize だけのドリンクを出力する予定だったが、定番レシピも一緒に出すことにする。ファイル名が少し気持ち悪いが、とりあえずこのままあとで直す
      if ($base === 'liquor') {
        $sql = "select * from liquomend.drinks where base in ('peach', 'cassis', 'kahlua', 'malibu', 'dita', 'other_liquor', 'liquor') ;";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        $drinks = [];
        if (pg_num_rows($result)) {
          while ($drink = pg_fetch_row($result)) {
            array_push($drinks, $drink);
          }
        }


        return $drinks;
      } else {
        $sql = "select * from liquomend.drinks where base = '$base' ;";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        $drinks = [];
        if (pg_num_rows($result)) {
          while ($drink = pg_fetch_row($result)) {
            array_push($drinks, $drink);
          }
        }


        return $drinks;
      }
    } else {
      if ($limit) {
        $sql = "select * from liquomend.drinks where type = '$type' limit $limit ;";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        $drinks = [];
        if (pg_num_rows($result)) {
          while ($drink = pg_fetch_row($result)) {
            array_push($drinks, $drink);
          }
        }

        return $drinks;
      } else {
        $sql = "select * from liquomend.drinks where type = '$type' ;";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        $drinks = [];
        if (pg_num_rows($result)) {
          while ($drink = pg_fetch_row($result)) {
            array_push($drinks, $drink);
          }
        }

        return $drinks;
      }
    }
  }
}
