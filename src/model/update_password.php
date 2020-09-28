<?php
require '../utils/connect.php';


function updatePassword($email, $pass, $n_pass, $c_pass, $id_u)
{
  if (!isset($email) && !isset($pass) && !isset($n_pass) && !isset($c_pass) && !isset($id_u)) {
    return 'empty';
  }

  $sql = "select hash_password from liquomend.users where id_u = $id_u and email = '$email' ;";
  $result = pg_query($sql) or die('Query failed: first ' . pg_last_error());

  if (pg_num_rows($result)) {
    $record = pg_fetch_row($result);
    $hash_pass = $record[0];
  } else {
    return 'confirm';
  }

  if (!password_verify($pass, $hash_pass)) {
    return 'password';
  }

  if ($n_pass !== $c_pass) {
    return 'match';
  }

  $new_hash_pass = password_hash($n_pass, PASSWORD_DEFAULT);

  $sql = "update liquomend.users set hash_password = '$new_hash_pass' where id_u = $id_u ;";
  $result = pg_query($sql) or die('Query failed: second ' . pg_last_error());

  if ($result) {
    return 'good';
  } else {
    return 'access';
  }
}
