<?php
require '../utils/index.php';

if ($_POST['confirm_btn']) {

  $uname = h($_POST['username']);
  $email = h($_POST['email']);
  $npw = h($_POST['password']);
  $cpw = h($_POST['password_confirm']);

  require '../model/confirm_user.php';
  if (confirmUser($uname, $email, $npw, $cpw)) {
    header('location: ../confirm.php');
  } else {
    header('location: ../register.php');
  }
}
