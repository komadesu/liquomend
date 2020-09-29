<?php
session_start();


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
