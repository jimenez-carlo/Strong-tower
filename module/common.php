<?php
if (!function_exists('clean_data')) {
  function clean_data($value)
  {
    $value = trim($value);
    $value = stripslashes($value);
    // $value = htmlspecialchars($value);
    return $value;
  }
}

if (!function_exists('get_contents')) {
  function get_contents($url, $data = array())
  {
    extract($data);
    ob_start();
    include($url);
    return ob_get_clean();
  }
}

if (!function_exists('get_access')) {
  function get_access($access)
  {
    switch ($access) {
      case 1: //admin
      case 5: //admin
        return array(
          'admin/clients',
          'admin/trainers',
          'admin/employees',
          'admin/client_plans',
          'admin/branches',
          'admin/plans',
          'admin/equipments',
          'admin/supplements',
          'admin/workouts',
          'admin/services',

          'admin/client_add',
          'admin/trainer_add',
          'admin/employee_add',
          'admin/client_plan_add',
          'admin/branch_add',
          'admin/plan_add',
          'admin/equipment_add',
          'admin/supplement_add',
          'admin/workout_add',
          'admin/services_add',

          'admin/client_edit',
          'admin/trainer_edit',
          'admin/employee_edit',
          'admin/client_plan_edit',
          'admin/branch_edit',
          'admin/plan_edit',
          'admin/equipment_edit',
          'admin/supplement_edit',
          'admin/workout_edit',
          'admin/service_edit',
        );


      default:
        return array();
    }
  }
}

if (!function_exists('page_url')) {
  function page_url($page)
  {
    switch ($page) {
        // Links
      case 'admin/clients':
        return 'layout/admin-page/content/client/index.php';
      case 'admin/trainers':
        return 'layout/admin-page/content/trainer/index.php';
      case 'admin/employees':
        return 'layout/admin-page/content/employee/index.php';
      case 'admin/client_plans':
        return 'layout/admin-page/content/client_plan/index.php';
      case 'admin/branches':
        return 'layout/admin-page/content/branch/index.php';
      case 'admin/plans':
        return 'layout/admin-page/content/plan/index.php';
      case 'admin/equipments':
        return 'layout/admin-page/content/equipment/index.php';
      case 'admin/supplements':
        return 'layout/admin-page/content/supplement/index.php';
      case 'admin/workouts':
        return 'layout/admin-page/content/workout/index.php';
      case 'admin/services':
        return 'layout/admin-page/content/services/index.php';

        // Add
      case 'admin/client_add':
        return 'layout/admin-page/content/client/create.php';
      case 'admin/trainer_add':
        return 'layout/admin-page/content/trainer/create.php';
      case 'admin/employee_add':
        return 'layout/admin-page/content/employee/create.php';
      case 'admin/client_plan_add':
        return 'layout/admin-page/content/client_plan/create.php';
      case 'admin/branch_add':
        return 'layout/admin-page/content/branch/create.php';
      case 'admin/plan_add':
        return 'layout/admin-page/content/plan/create.php';
      case 'admin/equipment_add':
        return 'layout/admin-page/content/equipment/create.php';
      case 'admin/supplement_add':
        return 'layout/admin-page/content/supplement/create.php';
      case 'admin/workout_add':
        return 'layout/admin-page/content/workout/create.php';
      case 'admin/services_add':
        return 'layout/admin-page/content/services/create.php';

        // Edit
      case 'admin/client_edit':
        return 'layout/admin-page/content/client/edit.php';
      case 'admin/trainer_edit':
        return 'layout/admin-page/content/trainer/edit.php';
      case 'admin/employee_edit':
        return 'layout/admin-page/content/employee/edit.php';
      case 'admin/client_plan_edit':
        return 'layout/admin-page/content/client_plan/edit.php';
      case 'admin/branch_edit':
        return 'layout/admin-page/content/branch/edit.php';
      case 'admin/plan_edit':
        return 'layout/admin-page/content/plan/edit.php';
      case 'admin/equipment_edit':
        return 'layout/admin-page/content/equipment/edit.php';
      case 'admin/supplement_edit':
        return 'layout/admin-page/content/supplement/edit.php';
      case 'admin/workout_edit':
        return 'layout/admin-page/content/workout/edit.php';
      case 'admin/service_edit':
        return 'layout/admin-page/content/services/edit.php';



      case 'denied':
        return 'layout/access_denied.php';
      default:
        return 'layout/not_found.php';
    }
  }
}

if (!function_exists('error_msg')) {
  function error_msg($message = "Oops Something Went Wrong!", $title = "Error! ")
  {
    $result = '<div class="alert alert-danger mt-3 mb-0" role="alert">
        <i class="fa fa-exclamation-triangle"></i>
        <strong>' . $title . '</strong>
        ' . $message . '
        <button type="button" class="btn-close pull-right" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    return $result;
  }
}

if (!function_exists('success_msg')) {
  function success_msg($message = "Action Successfull!", $title = "Successfull! ")
  {
    $result = '<div class="alert alert-success mt-3 mb-0" role="alert">
        <i class="fa fa-check"> </i>
        <strong>' . $title . '</strong>
        ' . $message . '
         <button type="button" class="btn-close pull-right" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    return $result;
  }
}


if (!function_exists('def_response')) {
  function def_response()
  {
    $result = new stdClass();
    $result->status = false;
    $result->result = error_msg();
    $result->items = '';
    return $result;
  }
}
