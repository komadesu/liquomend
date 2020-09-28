<?php
session_start();
require '../utils/index.php';

ini_set('display_errors', 1);

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

$search_btn = h($_REQUEST['search_btn']);
$str = h($_REQUEST['str']);

if ($search_btn) {

  if ($str === '') {
    $message = '検索ワードを入力してください';
    $_SESSION['search_drinks'] = null;
  } else {
    require '../model/search_drinks.php';
    $search_result = searchDrinks($str);
    $drinks = $search_result[0];
    $search_word = $search_result[1];
    if ($drinks) {
      $_SESSION['search_drinks'] = $drinks;
      $_SESSION['search_word'] = $search_word;
    } else {
      $message = '検索ワードを入力してください';
    }
  }
} else {
  $message = '不正なアクセスです';
}
if (isset($message)) {
  $_SESSION['error_message'] = $message;
}
header('location: ../search.php');
