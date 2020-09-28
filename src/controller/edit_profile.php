<?php
session_start();
require '../utils/index.php';

ini_set('display_errors', 1);

$id_u = $_SESSION['user_id'];
$uname = $_SESSION['user_name'];
$uicon = $_SESSION['user_icon'];

if (!$id_u) {
  header('location: ../login.php');
  exit;
}


$_SESSION['errors']['empty'] = null;
$_SESSION['errors']['confirm'] = null;
$_SESSION['errors']['password'] = null;
$_SESSION['errors']['match'] = null;
$_SESSION['errors']['access'] = null;
$_SESSION['good'] = null;


$email = h($_POST['email']);
$pass = h($_POST['password']);
$n_pass = h($_POST['new_password']);
$c_pass = h($_POST['confirm_password']);


if (isset($_POST['update_password_btn'])) {
  require '../model/update_password.php';
  $result = updatePassword($email, $pass, $n_pass, $c_pass, $id_u);

  if ($result = 'empty') {
    $_SESSION['errors']['empty'] = true;
    header('location: ../edit-profile.php');
    exit;
  }
  if ($result = 'confirm') {
    $_SESSION['errors']['confirm'] = true;
    header('location: ../edit-profile.php');
    exit;
  }
  if ($result = 'password') {
    $_SESSION['errors']['password'] = true;
    header('location: ../edit-profile.php');
    exit;
  }
  if ($result = 'match') {
    $_SESSION['errors']['match'] = true;
    header('location: ../edit-profile.php');
    exit;
  }
  if ($result = 'access') {
    $_SESSION['errors']['access'] = true;
    header('location: ../edit-profile.php');
    exit;
  }
  if ($result = 'good') {
    $_SESSION['good'] = true;
  }
}
header('location: ../edit-profile.php');
