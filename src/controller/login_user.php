<?php
require '../utils/index.php';

ini_set('display_errors', 1);

if ($_POST['login_btn']) {

  $email = h(trimInputStr($_POST['email']));
  $pw = h(trimInputStr($_POST['password']));

  require '../model/login_user.php';
  if (loginUser($email, $pw)) {
    header('location: ./home.php');
  } else {
    header('location: ../login.php');
  }
}
