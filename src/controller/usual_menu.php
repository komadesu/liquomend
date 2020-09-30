<?php
session_start();


$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

require '../model/get_user_icon.php';
$uicon = getUserIcon($id_u, $uname);

if ($uicon) {
  $_SESSION['user_icon'] = $uicon;
}


require '../model/get_drinks.php';

$usual_drinks = getDrinks('usual', null, null, null);
$_SESSION['usual_drinks'] = $usual_drinks;

header('location: ../usual-menu.php');
