<?php
require '../utils/connect.php';



function getUserIcon($id_u, $uname)
{
  $sql = "select uicon from liquomend.users where id_u = $id_u and uname = '$uname' ; ";
  $result = pg_query($sql) or die('Query failed: first ' . pg_last_error());

  if (pg_num_rows($result)) {
    $record = pg_fetch_row($result);
    $uicon = $record[0];
    return $uicon;
  } else {
    return false;
  }
}
