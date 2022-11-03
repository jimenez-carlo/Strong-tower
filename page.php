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
    case 'admin/client_plans':
      $data['users'] = $base->get_list("select tp.name as 'plan',b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.*,ui2.first_name as `t_first_name`,ui2.middle_name as `t_middle_name`, ui2.last_name as `t_last_name`,tc.id from tbl_client_plan tc inner join tbl_user u on u.id = tc.client_id inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id inner join tbl_plan tp on tp.id = tc.plan_id  inner join tbl_user_info ui2 on ui2.id = tc.trainer_id where u.access_id = 5 and tc.deleted_flag = 0");
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

    case 'admin/client_plan_add':
      $data['trainer'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id = 3 and u.deleted_flag = 0");
      $data['client'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id = 5 and u.deleted_flag = 0 and  (u.client_plan_id = 0 OR  u.plan_expiration_date > CURDATE() )");
      $data['plans'] = $base->get_list("select * from tbl_plan where deleted_flag = 0");
      $data['workout'] = $base->get_list("select * from tbl_workout where deleted_flag = 0");
      break;

    case 'admin/trainer_add':
    case 'admin/client_add':
    case 'admin/employee_add':
      $data['gender'] = $base->get_list("select * from tbl_gender where deleted_flag = 0");
      $data['access'] = $base->get_list("select * from tbl_access where id in(2,3,4) and deleted_flag = 0");
      break;
    case 'admin/client_edit':
      $data['client'] = $base->get_one("SELECT tp.*,u.*,ui.* FROM tbl_user u inner join tbl_user_info ui on ui.id = u.id left join tbl_client_plan tc on tc.id = u.client_plan_id left join tbl_plan tp on tp.id = tc.plan_id where u.id = $id");
      $data['branch'] = $base->get_list("select * from tbl_branch where deleted_flag = 0");
      $data['gender'] = $base->get_list("select * from tbl_gender where deleted_flag = 0");
      break;
    case 'admin/trainer_edit':
      $data['trainer'] = $base->get_one("SELECT u.*,ui.* FROM tbl_user u inner join tbl_user_info ui on ui.id = u.id where u.id = $id");
      $data['branch'] = $base->get_list("select * from tbl_branch where deleted_flag = 0");
      $data['gender'] = $base->get_list("select * from tbl_gender where deleted_flag = 0");
      break;
    case 'admin/client_plan_edit':
      $data['client_plan'] = $base->get_one("SELECT * from tbl_client_plan where id = $id");
      $data['client_workout'] = $base->get_list("SELECT * from tbl_workout_plan where client_plan_id = $id");
      $client_id = $data['client_plan']->client_id;
      $data['trainer'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id = 3 and u.deleted_flag = 0");
      $data['client'] = $base->get_list("select b.name as `branch`,g.name as `gender`,UPPER(a.name) as 'access',ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_access a on a.id = u.access_id inner join tbl_gender g on g.id = ui.gender_id inner join tbl_branch b on b.id = u.branch_id where u.access_id = 5 and u.deleted_flag = 0 and  (u.client_plan_id = 0 OR  u.plan_expiration_date > CURDATE() OR u.id = $client_id)");
      $data['plans'] = $base->get_list("select * from tbl_plan where deleted_flag = 0");
      $data['workout'] = $base->get_list("select * from tbl_workout where deleted_flag = 0");

      break;
    case 'admin/employee_edit':
      $data['employee'] = $base->get_one("SELECT u.*,ui.* FROM tbl_user u inner join tbl_user_info ui on ui.id = u.id where u.id = $id");
      $data['branch'] = $base->get_list("select * from tbl_branch where deleted_flag = 0");
      $data['gender'] = $base->get_list("select * from tbl_gender where deleted_flag = 0");
      $data['access'] = $base->get_list("select * from tbl_access where id in(2,3,4) and deleted_flag = 0");
      break;
    case 'admin/client_edit':
      $data['branch'] = $base->get_one("select * from tbl_branch where id = $id");
      break;
    case 'admin/branch_edit':
      $data['branch'] = $base->get_one("select * from tbl_branch where id = $id");
      break;
    case 'admin/plan_edit':
      $data['plan'] = $base->get_one("select * from tbl_plan where id = $id");
      break;
    case 'admin/equipment_edit':
      $data['equipment'] = $base->get_one("select * from tbl_equipment where id = $id");
      break;
    case 'admin/supplement_edit':
      $data['supplement'] = $base->get_one("select * from tbl_supplements where id = $id");
      break;
    case 'admin/workout_edit':
      $data['workout'] = $base->get_one("select * from tbl_workout where id = $id");
      break;
  }
  echo get_contents(page_url($page), $data);
  die;
} else {
  echo get_contents(page_url('denied'));
  die;
}
