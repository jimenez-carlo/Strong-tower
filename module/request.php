<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('../class/user.php');
require_once('../class/shop.php');
require_once('../class/product.php');
require_once('../class/category.php');
require_once('common.php');

$base = new Base($conn);
$result = $base->response_error();

if (!$_POST || !isset($_POST['form'])) {
  echo json_encode($result);
  die;
}

$form = $_POST['form'];
$base = new Base($conn);
$user = new User($conn);
$login = new Login($conn);
$shop = new Shop($conn);
$product = new Product($conn);
$category = new Category($conn);

switch ($form) {
    // Customer
  case 'landing_signup':
    $result = $base->response_landing_obj();
    $result = $login->login();
    break;
  case 'landing_login':
    $result = $base->response_landing_obj();
    $result = $login->register();
    break;
  case 'update_transaction':
    $result = $shop->update_transaction($_POST['id'], $_POST['status']);
    break;
  default:
    # code...
    break;
}
echo json_encode($result);
die;
