<?php
require '../utils/connect.php';


function insertData($id_d, $arry, $table)
{
  $success = false;

  switch ($table) {
    case 'ingredients':
      foreach ($arry as $data) {
        $data = h($data);
        if (!$data) {
          break;
        }

        $sql = "insert into liquomend.ingredients (id_d, ingredient) values ('$id_d', '$data');";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        $success = $result;
      }
      break;

    case 'quantities':
      foreach ($arry as $data) {
        $data = h($data);
        if (!$data) {
          break;
        }

        $sql = "insert into liquomend.quantities (id_d, quantity) values ('$id_d', '$data');";
        $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
        $success = $result;
      }
      break;
  }

  if ($success) {
    return true;
  } else {
    return false;
  }
}
