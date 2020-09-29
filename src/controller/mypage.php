<?php
session_start();
require '../utils/index.php';

ini_set('display_errors', 1);

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
// $uicon = $_SESSION['user_icon'];

if (!$id_u) {
  header('location: ../login.php');
  exit;
}

require '../model/get_drinks.php';
$drinks = getDrinks(null, null, null, $id_u);
$_SESSION['your_drinks'] = $drinks;

$drinks = getDrinks(null, null, null, $id_u); // とりあえず上のと同じやつ、あとでお気に入りドリンクのみ引っ張ってくる
$_SESSION['your_favorite_drinks'] = $drinks;



$sql = "select uicon from liquomend.users where id_u = $id_u and uname = '$uname' ; ";
$result = pg_query($sql) or die('Query failed: first ' . pg_last_error());

if (pg_num_rows($result)) {
  $uicon = pg_fetch_row($result);
  $uicon = $uicon[0];
  $_SESSION['user_icon'] = $uicon;
}
header('location: ../mypage.php');