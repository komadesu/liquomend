<?php
session_start();
require '../utils/index.php';

ini_set('display_errors', 1);

$id_d = h($_REQUEST['id_d']);
$_SESSION['id_d'] = $id_d;


require '../model/get_drink_detail.php';
$drink_detail = getDrinkDetail($id_d);
$_SESSION['drink_detail'] = $drink_detail;
$base = $_SESSION['drink_detail'][1];


require '../model/get_drinks.php';
$three_customize_drinks = getDrinks('customize', 3, $base, null);
$_SESSION['three_customize_drinks'] = $three_customize_drinks;

header('location: ../detail.php');
