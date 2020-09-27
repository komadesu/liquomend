<?php
ini_set('session.save_path', realpath('../../session'));
session_start();


require '../model/get_drinks.php';

$usual_drinks = getDrinks('usual', null);
$_SESSION['usual_drinks'] = $usual_drinks;

header('location: ../usual-menu.php');
