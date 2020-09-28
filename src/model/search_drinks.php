<?php
require '../utils/connect.php';


function searchDrinks($str)
{
  if (isset($str)) {
    $search_word = h($_REQUEST['str']);

    $sql = "select * from liquomend.drinks where name like '%${search_word}%'  ;";
    $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
    $drinks = [];
    if (pg_num_rows($result)) {
      while ($drink = pg_fetch_row($result)) {
        array_push($drinks, $drink);
      }
    }

    return [$drinks, $search_word];
  } else {
    return false;
  }
}
