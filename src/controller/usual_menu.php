<?php
session_start();


require '../model/get_drinks.php';

$usual_drinks = getDrinks('usual', null, null, null);
$_SESSION['usual_drinks'] = $usual_drinks;

header('location: ../usual-menu.php');
