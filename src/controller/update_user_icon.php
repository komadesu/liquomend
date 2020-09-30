<?php
session_start();
require '../utils/index.php';
ini_set('display_errors', 1);
// このファイルは、ユーザーが画像を設定し、ページが遷移したタイミングで、JS からの非同期通信を受け取って、処理する API　である

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

if (!isset($id_u) && !isset($uname)) {
  header('location: ../login.php');
  exit(0);
}

if (isset($_FILES['user_icon_image']) && is_uploaded_file($_FILES['user_icon_image']['tmp_name'])) {
  $img = file_get_contents($_FILES['user_icon_image']['tmp_name']);
  $files = $_FILES;
} else {
  $files = null;
}

if (isset($files)) {
  require '../model/update_user_icon.php';
  $files = updateUserIcon($id_u, $uname, $files);



  if (!isset($files)) {
    http_response_code(400);
    echo "<p>upload failed</p>";
  } else {
    http_response_code(200);
    echo '<img src="data:image/jpg;base64,' . base64_encode($img) . '" alt="user icon image" class="circle js-usericon-btn"  />';
    exit(0);
  }
}
