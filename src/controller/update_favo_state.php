<?php
session_start();
require '../utils/index.php';
ini_set('display_errors', 1);
// このファイルは、ユーザーが Favo 用スターボタンを押下し実行される JS からの非同期通信を受け取って、スターの状態を管理する API　である

$id_d = $_SESSION['id_d'];
$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];

if (!isset($id_u) && !isset($uname)) {
  header('location: ../login.php');
  exit(0);
}



if (isset($_POST['star_state'])) {
  require '../model/update_favo_state.php';
  $state = $_POST['star_state'];
  $result = updateFavoState($id_d, $id_u, $state);

  if ($result === 'registered') {
    http_response_code(200);
    $response = '<i class="fas fa-star star-btn js-star-btn"></i>';
    echo $response;
    $_SESSION['which_star'] = 'active';
    exit(0);
  }

  if ($result === 'unregistered') {
    http_response_code(200);
    $response = '<i class="far fa-star star-btn js-star-btn"></i>';
    echo $response;
    $_SESSION['which_star'] = 'inactive';
    exit(0);
  }
} else {
  http_response_code(400);
  echo "<p>data is not sent</p>";
}
