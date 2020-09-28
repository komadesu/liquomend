<?php
session_start();
require '../utils/connect.php';


function createUser($uname, $email, $hpw)
{
  $_SESSION['good'] = false;
  $errors = $_SESSION['errors'];
  $errors['server'] = false;

  $sql = "insert into liquomend.users (uname, email, hash_password, uicon) values ('$uname', '$email', '$hpw', null);";
  $result = pg_query($sql) or die('query failed: ' . pg_last_error());

  if ($result) {
    $_SESSION['good'] = true;
    return true;
  } else {
    session_destroy();
    $errors['server'] = true;
    return false;
  }
}
