<?php
ini_set('session.save_path', realpath('../../session'));
session_start();


require '../model/get_drinks.php';

$three_recommend_drinks = getDrinks('customize', 3, null);
$_SESSION['three_recommend_drinks'] = $three_recommend_drinks;

$three_usual_drinks = getDrinks('usual', 3, null);
$_SESSION['three_usual_drinks'] = $three_usual_drinks;

header('location: ../home.php');
