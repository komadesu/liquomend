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
if (isset($drinks)) {
  $_SESSION['your_drinks'] = $drinks;
} else {
  $_SESSION['your_drinks'] = null;
}

require '../model/get_favorite_drinks.php';
$favo_drinks = getFavoriteDrinks($id_u);
if (isset($favo_drinks)) {
  $_SESSION['your_favorite_drinks'] = $favo_drinks;
} else {
  $_SESSION['your_favorite_drinks'] = null;
}

require '../model/get_user_icon.php';
$uicon = getUserIcon($id_u, $uname);

if ($uicon) {
  $_SESSION['user_icon'] = $uicon;
}
header('location: ../mypage.php');