<?php
session_start();


require '../utils/index.php';
$base = h($_REQUEST['base']);
$_SESSION['base'] = $base;


require '../model/get_drinks.php';
$all_drinks = getDrinks(null, null, $base, null);
$_SESSION['all_drinks'] = $all_drinks;
header('location: ../customize-menu.php');
