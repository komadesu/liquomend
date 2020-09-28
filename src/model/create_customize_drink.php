<?php
require '../utils/connect.php';


function createCustomizeDrink($id_u, $name, $default_base, $accurate_base, $strength, $memo, $image_path)
{
  if (!$accurate_base) {
    $base = $default_base;
  } else {
    $base = $accurate_base;
  }

  $sql = "insert into liquomend.drinks
                          (id_u, name, base, strength, memo, image, type)
                      values
                          ('$id_u', '$name', '$base', '$strength', '$memo', '$image_path', 'customize');";

  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());

  return $result;
}
