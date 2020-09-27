<?php
require '../utils/index.php';

if ($_POST['confirm_btn']) {

  $uname = h(trimInputStr($_POST['username']));
  $email = h(trimInputStr($_POST['email']));
  $npw = h(trimInputStr($_POST['password']));
  $cpw = h(trimInputStr($_POST['password_confirm']));

  require '../model/confirm_user.php';
  if (confirmUser($uname, $email, $npw, $cpw)) {
    header('location: ../confirm.php');
  } else {
    header('location: ../register.php');
  }
}
