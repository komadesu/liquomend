<?php
require '../utils/connect.php';

function updateFavoState($id_d, $id_u, $state)
{

  if ($state === 'active') {
    $sql = "insert into liquomend.favorites (id_d, id_u) values ($id_d, $id_u) ; ";
    $result = pg_query($sql) or die('Query failed: first ' . pg_last_error());

    if ($result) {
      return 'registered';
    } else {
      return false;
    }
  }


  if ($state === 'inactive') {
    $sql = "delete from liquomend.favorites where id_d = $id_d and id_u = $id_u ; ";
    $result = pg_query($sql) or die('Query failed: first ' . pg_last_error());
    if ($result) {
      return 'unregistered';
    } else {
      return false;
    }
  }
}
