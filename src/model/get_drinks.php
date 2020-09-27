<?php
require '../utils/connect.php';


function getDrinks($type, $limit)
{
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
