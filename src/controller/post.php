<?php
session_start();
require '../utils/index.php';

ini_set('display_errors', 1);


if (isset($_POST['recipe_post_btn'])) {
  $id_u = $_SESSION['user_id'];

  $name = h($_POST['recipe_name']);
  $default_base = h($_POST['recipe_base']);
  $accurate_base = h($_POST['accurate_recipe_base']);
  $strength = h($_POST['recipe_strength']);
  $ingredients = $_POST['recipe_ingredients'];
  $quantities = $_POST['recipe_quantities'];
  $memo = h($_POST['recipe_memo']);

  if (isset($_FILES)) $files = $_FILES;

  require '../model/detect_errors.php';
  $errors = detectErrors($files, $name, $default_base, $ingredients, $quantities, $memo);
  if ($errors) {
    $_SESSION['errors'] = $errors;
    header('location: ../post.php');
  }


  require '../model/upload_file.php';
  $image_path = uploadFile($files);
  if (!$image_path) {
    $_SESSION['errors']['$image_path'] = true;
    // header('location: ../post.php');
  } else {
    $_SESSION['errors']['$image_path'] = false;
  }


  require '../model/create_customize_drink.php';
  $result = createCustomizeDrink($id_u, $name, $default_base, $accurate_base, $strength, $memo, $image_path);
  if (!$result) {
    $_SESSION['errors']['$server'] = true;
    // header('location: ../post.php');
  }


  require '../model/get_drink_id.php';
  $id_d = getDrinkId($id_u, $image_path);
  if (!$id_d) {
    $_SESSION['errors']['$drink_id'] = true;
    header('location: ../post.php');
  }


  require '../model/insert_data.php';
  $result = insertData($id_d, $ingredients, 'ingredients');
  if (!$result) {
    $_SESSION['errors']['server'] = true;
    header('location: ../post.php');
  }

  $result = insertData($id_d, $quantities, 'quantities');
  if (!$result) {
    $_SESSION['errors']['server'] = true;
    header('location: ../post.php');
  }
  header('location: ./mypage.php');


} else {
  $id_u = $_SESSION['user_id'];
  if (!$id_u) {
    header('location: ../login.php');
    exit;
  } else {
    header('location: ../post.php');
  }
}

