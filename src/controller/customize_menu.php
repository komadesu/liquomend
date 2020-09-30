<?php
session_start();



$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

require '../model/get_user_icon.php';
$uicon = getUserIcon($id_u, $uname);

if ($uicon) {
  $_SESSION['user_icon'] = $uicon;
}


require '../utils/index.php';
$base = h($_REQUEST['base']);

if ($base === 'peach' || $base === 'cassis' || $base === 'kahlua' || $base === 'malibu' || $base === 'dita' || $base === 'other_liquor') {
  $base = 'liquor';
}
$_SESSION['base'] = $base;


require '../model/get_drinks.php';
$all_drinks = getDrinks(null, null, $base, null);
$_SESSION['all_drinks'] = $all_drinks;
header('location: ../customize-menu.php');
