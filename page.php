<?php
require('database/connection.php');
require_once('class/base.php');
require_once('class/shop.php');
require_once('module/common.php');

if (!$_GET || !isset($_GET['page'])) {
  echo get_contents('layout/not_found.php');
  die;
}

$page = $_GET['page'];
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$access = $_SESSION['user']->access_id;
$customer_id = $_SESSION['user']->id;
$pages = get_access($access);

if (in_array($page, $pages)) {
  $data = array();
  $base = new Base($conn);
  $shop = new Shop($conn);
  switch ($page) {
      // Admin
    case 'admin/clients':
      $data['users'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id = 5 and u.deleted_flag = 0");
      break;
    case 'admin/trainers':
      $data['users'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id = 3 and u.deleted_flag = 0");
      break;
    case 'admin/employees':
      $data['users'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id in(2,3,4) and u.deleted_flag = 0");
      break;
    case 'admin/branches':
      $data['branches'] = $base->get_list("select * from tbl_branch where deleted_flag = 0");
      break;
    case 'admin/plans':
      $data['plans'] = $base->get_list("select * from tbl_plan where deleted_flag = 0");
      break;
    case 'admin/equipments':
      $data['plans'] = $base->get_list("select * from tbl_equipment where deleted_flag = 0");
      break;
    case 'admin/supplements':
      $data['supplements'] = $base->get_list("select * from tbl_supplements where deleted_flag = 0");
      break;
    case 'admin/workouts':
      $data['workouts'] = $base->get_list("select * from tbl_workout where deleted_flag = 0");
      break;
  }
  echo get_contents(page_url($page), $data);
  die;
} else {
  echo get_contents(page_url('denied'));
  die;
}
