<?php
require '../utils/index.php';

ini_set('display_errors', 1);


$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

require '../model/get_user_icon.php';
$uicon = getUserIcon($id_u, $uname);

if ($uicon) {
  $_SESSION['user_icon'] = $uicon;
}



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
