<?php
require '../utils/connect.php';


function getDrinkDetail($id_d)
{
  $drink_detail = [];

  $sql = "select * from liquomend.drinks where id_d = $id_d ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  if (pg_num_rows($result)) {
    $drink = pg_fetch_row($result);

    $name = $drink[2];
    $memo = $drink[5];
    $image = $drink[6];

    array_push($drink_detail, $name, $memo, $image);
  }

  $sql = "select liquomend.ingredients.ingredient, liquomend.quantities.quantity from liquomend.drinks inner join liquomend.ingredients on liquomend.drinks.id_d = liquomend.ingredients.id_d inner join liquomend.quantities on liquomend.drinks.id_d = liquomend.quantities.id_d and liquomend.ingredients.id_i = liquomend.quantities.id_q where liquomend.drinks.id_d = $id_d ;";
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  $ingredients_and_quantities = [];
  if (pg_num_rows($result)) {
    while ($record = pg_fetch_row($result)) {
      $ingredient_and_quantity = [];

      array_push($ingredient_and_quantity, $record[0]);
      array_push($ingredient_and_quantity, $record[1]);

      array_push($ingredients_and_quantities, $ingredient_and_quantity);
    }
  }

  array_push($drink_detail, $ingredients_and_quantities);



  return $drink_detail;
}

