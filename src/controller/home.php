<?php
ini_set('session.save_path', realpath('../../session'));
session_start();


require '../model/get_drinks.php';

$recommend_drinks = getDrinks('customize', 3);
$_SESSION['recommend_drinks'] = $recommend_drinks;

$usual_drinks = getDrinks('usual', 3);
$_SESSION['usual_drinks'] = $usual_drinks;

header('location: ../home.php');
