<?php
require('database/connection.php');
require('class/base.php');
$base = new Base($conn);
if (!isset($_SESSION['base_url'])) {
  $_SESSION['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

if (isset($_SESSION['is_logged_in'])) {
  if (in_array($_SESSION['user']->access_id, array(5))) {
    // Customer
    include('layout/customer-page/header.php');
    include('layout/customer-page/body.php');
    include('layout/customer-page/footer.php');
  } else if (in_array($_SESSION['user']->access_id, array(2, 3, 4))) {
    // Trainer,Staff,Manager
    include('layout/customer-page/header.php');
    include('layout/customer-page/body.php');
    include('layout/customer-page/footer.php');
  } else {
    // admin
    include('layout/user-page/header.php');
    include('layout/user-page/body.php');
    include('layout/user-page/footer.php');
  }
} else {
  include('layout/landing-page/header.php');
  $branch = $base->get_list("Select * from tbl_branch where deleted_flag = 0");
  $gender = $base->get_list("Select * from tbl_gender where deleted_flag = 0");
  include('layout/landing-page/body.php');
  include('layout/landing-page/footer.php');
}
