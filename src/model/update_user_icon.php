<?php
require '../utils/connect.php';

function updateUserIcon($id_u, $uname, $files)
{
  $image_path = '';

  $unique_id = uniqid(mt_rand(), true);
  $save_path = $_SERVER['DOCUMENT_ROOT'] . '/liquomend/src/upload_files/user_icons/';
  $destination = $save_path . $unique_id . basename($files['user_icon_image']['name']);

  if (move_uploaded_file($files['user_icon_image']['tmp_name'], $destination)) {
    $files['user_icon_image'] = false;
    $image_path = str_replace("/var/www/html/liquomend/src/", "", $destination);
  } else {
    return false;
  }


  if ($image_path !== '') {
    $sql = "update liquomend.users set uicon = '$image_path' where id_u = $id_u and uname = '$uname' ;";
    $result = pg_query($sql) or die('Query failed: first ' . pg_last_error());

    if (pg_num_rows($result)) {
      return $files;
    } else {
      return false;
    }
  }
}
