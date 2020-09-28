<?php
require '../utils/connect.php';


function getDrinkId($id_u, $image_path)
{

  $sql = "select id_d from liquomend.drinks where liquomend.drinks.id_u = '$id_u' and liquomend.drinks.image = '$image_path' ; ";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

  if (pg_num_rows($result)) {
    $drink = pg_fetch_row($result);

    $id_d = $drink[0];
  }

  return $id_d;
}
