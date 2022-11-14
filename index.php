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
    include('layout/client-page/header.php');
    include('layout/client-page/body.php');
    include('layout/client-page/footer.php');
  } else if (in_array($_SESSION['user']->access_id, array(1, 2, 3, 4))) {
    // Admin,Trainer,Staff,Manager
    include('layout/admin-page/header.php');
    include('layout/admin-page/body.php');
    include('layout/admin-page/footer.php');
  }
} else {
  include('layout/landing-page/header.php');
  include('layout/landing-page/body.php');
  include('layout/landing-page/footer.php');
}
