<?php
require '../utils/connect.php';

function judgeFavoState($id_d, $id_u)
{
  $state = '';

  $sql = "select id_f from liquomend.favorites where id_d = $id_d and id_u = $id_u ; ";
  $result = pg_query($sql) or die('Query failed: first ' . pg_last_error());

  if (pg_num_rows($result)) {
    $state = 'registered';
  } else {
    $state = 'unregistered';
  }

  return $state;
}
