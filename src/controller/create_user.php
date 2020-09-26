<?php
require '../utils/index.php';

if ($_POST['register_btn']) {

  $uname = h($_POST['username']);
  $email = h($_POST['email']);
  $hpw = h($_POST['hash_password']);

  require '../model/create_user.php';
  if (createUser($uname, $email, $hpw)) {
    header('location: ../thanks.php');
  } else {
    header('location: ../register.php');
  }
}
