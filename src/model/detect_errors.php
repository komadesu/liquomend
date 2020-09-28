<?php

function detectErrors($files, $name, $default_base, $ingredients, $quantities, $memo)
{
  $errors = [];

  if (!isset($files['recipe_image']['tmp_name']) || !is_uploaded_file($files['recipe_image']['tmp_name'])) {
    $errors['upload'] = true;
  }
  if (!isset($name)) {
    $errors['name'] = true;
  }
  if (!isset($default_base)) {
    $errors['default_base'] = true;
  }
  $count_i = 0;
  foreach ($ingredients as $ingredient) {
    if (isset($ingredient)) {
      $count_i++;
    } else {
      break;
    }
  }
  $count_q = 0;
  foreach ($quantities as $quantity) {
    if (isset($quantity)) {
      $count_q++;
    } else {
      break;
    }
  }
  if ((!isset($count_i) || !isset($count_q))) {
    $errors['ingredients_and_quantities'] = true;
  }
  if ($count_i !== $count_q) {
    $errors['order'] = true;
  }
  if (!isset($memo)) {
    $errors['memo'] = true;
  }

  if (empty($errors)) {
    return false;
  } else {
    return $errors;
  }
}
