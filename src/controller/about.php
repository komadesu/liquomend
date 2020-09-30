<?php
session_start();


$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

if (isset($id_u) && isset($uname)) {
  require '../model/get_user_icon.php';
  $uicon = getUserIcon($id_u, $uname);

  if ($uicon) {
    $_SESSION['user_icon'] = $uicon;
  }
}
header('location: ../about.php');
