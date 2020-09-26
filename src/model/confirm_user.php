<?php
ini_set('session.save_path', realpath('../../session'));
session_start();
require '../utils/connect.php';


function confirmUser($uname, $email, $npw, $cpw)
{
  $errors = $_SESSION['errors'];
  $errors['empty'] = false;
  $errors['confirm'] = false;
  $errors['id'] = false;

  $unamenum = strlen($uname);
  $emailnum = strlen($email);
  $npwnum = strlen($npw);
  $cpwnum = strlen($cpw);

  if (!$unamenum || !$emailnum || !$npwnum || !$cpwnum) {
    $errors['empty'] = true;
  }

  if ($npw !== $cpw) {
    $errors['confirm'] = true;
  }

  $sql = "select * from liquomend.users where email = '$email' ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

  $user = pg_num_rows($result);
  if ($user) {
    $errors['id'] = true;
  }


  if (!$errors['empty'] && !$errors['id'] && !$errors['confirm']) {
    $hpw = password_hash($npw, PASSWORD_DEFAULT);

    $_SESSION['user_name'] = $uname;
    $_SESSION['email'] = $email;
    $_SESSION['hash_password'] = $hpw;
    return true;

  } else {
    return false;
  }
}
