<?php
session_start();
require '../utils/index.php';

ini_set('display_errors', 1);

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

if (!$id_u) {
  header('location: ../login.php');
  exit;
}

require '../model/get_drinks.php';
$drinks = getDrinks(null, null, null, $id_u);
$_SESSION['your_drinks'] = $drinks;

$drinks = getDrinks(null, null, null, $id_u); // とりあえず上のと同じやつ、あとでお気に入りドリンクのみ引っ張ってくる
$_SESSION['your_favorite_drinks'] = $drinks;

require '../model/get_user_icon.php';
$uicon = getUserIcon($id_u, $uname);

if ($uicon) {
  $_SESSION['user_icon'] = $uicon;
}
header('location: ../mypage.php');