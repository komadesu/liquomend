<?php
session_start();

ini_set('display_errors', 1);


$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

require '../model/get_user_icon.php';
$uicon = getUserIcon($id_u, $uname);

if ($uicon) {
  $_SESSION['user_icon'] = $uicon;
}



require '../model/get_drinks.php';

$three_recommend_drinks = getDrinks('customize', 3, null, null);
$_SESSION['three_recommend_drinks'] = $three_recommend_drinks;

$three_usual_drinks = getDrinks('usual', 3, null, null);
$_SESSION['three_usual_drinks'] = $three_usual_drinks;

header('location: ../home.php');
