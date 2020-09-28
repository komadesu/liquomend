<?php
session_start();
require '../utils/connect.php';


function loginUser($email, $pw)
{
  $_SESSION['errors']['empty'] = false;
  $_SESSION['errors']['id'] = false;
  $_SESSION['errors']['confirm'] = false;

  $emailnum = strlen($email);
  $pwnum = strlen($pw);

  if (!$emailnum || !$pwnum) {
    $_SESSION['errors']['empty'] = true;
  }

  $sql = "select * from liquomend.users where email = '$email' ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

  if (!pg_num_rows($result)) {
    $_SESSION['errors']['id'] = true;
  } else {
    $user_info = pg_fetch_row($result);

    $id_u = $user_info[0];
    $uname = $user_info[1];
    $hash_password = $user_info[3];
    $uicon = $user_info[4];


    if (!password_verify($pw, $hash_password)) {
      $_SESSION['errors']['confirm'] = true;
    }
  }

  if (!$_SESSION['errors']['empty'] && !$_SESSION['errors']['id'] && !$_SESSION['errors']['confirm']) {
    $_SESSION['user_id'] = $id_u;
    $_SESSION['user_name'] = $uname;
    $_SESSION['email'] = $email;
    $_SESSION['user_icon'] = $uicon;
    return true;
  } else {
    $_SESSION['email'] = $email;
    return false;
  }
}
