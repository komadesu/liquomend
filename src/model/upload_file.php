<?php

function uploadFile($files)
{
  $unique_id = uniqid(mt_rand(), true);
  $save_path = $_SERVER['DOCUMENT_ROOT'] . '/liquomend/src/upload_files/drinks/';
  $destination = $save_path . $unique_id . basename($files['recipe_image']['name']);

  if (move_uploaded_file($files['recipe_image']['tmp_name'], $destination)) {
    $files['recipe_image'] = false;
    // /var/www/html/liquomend/src/upload_files/drinks/14116398135f717f338...
    $image_path = str_replace("/var/www/html/liquomend/src/", "", $destination);
    return $image_path;
  } else {
    return false;
  }
}
