<?php
ini_set('session.save_path', realpath('../../session'));
session_start();


require '../utils/index.php';
$base = h($_REQUEST['base']);
$_SESSION['base'] = $base;


require '../model/get_drinks.php';
$all_drinks = getDrinks(null, null, $base);
$_SESSION['all_drinks'] = $all_drinks;

header('location: ../customize-menu.php');
