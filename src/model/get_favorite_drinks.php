<?php
require '../utils/connect.php';


function getFavoriteDrinks($id_u)
{

  // select id_d from favorites where id_u = 2; ユーザの ID に合致したレコードのドリンク ID を配列で取得する
  // そのドリンクの ID (id_d) をループさせて、
  // $drink_ids のような変数に文字列として格納する。フォーマットを
  // '5,7,12,15,24' このように、カンマで区切って文字列とする。
  // select * from drinks where id_d in (2, 3, 13, 18, 33);
  // このようにして、drinks テーブルから、先ほど文字列として抽出した、id_d を in 句で取得する。
  // そのデータを返して上げて、controller で session に格納
  // view のページにてそれを取得し、出力させる。


  if ($id_u) {
    $sql = "select id_d from liquomend.favorites where id_u = '$id_u' ;";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
    $favo_drink_ids = [];
    if (pg_num_rows($result)) {
      while ($record = pg_fetch_row($result)) {
        $drink_id = $record[0];
        array_push($favo_drink_ids, $drink_id);
      }
    } else {
      return null;
    }

    $favo_drink_ids = implode(',', $favo_drink_ids);

    $sql = "select * from liquomend.drinks where id_d in ($favo_drink_ids); ";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
    $favo_drinks = [];
    if (pg_num_rows($result)) {
      while ($favo_drink = pg_fetch_row($result)) {
        array_push($favo_drinks, $favo_drink);
      }
    }

    return $favo_drinks;
  }
}
