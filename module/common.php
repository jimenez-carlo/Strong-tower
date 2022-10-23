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
          'admin/branches',
          'admin/plans',
          'admin/equipments',
          'admin/supplements',
          'admin/workouts',
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
      case 'admin/clients':
        return 'layout/admin-page/content/client/index.php';
      case 'admin/trainers':
        return 'layout/admin-page/content/trainer/index.php';
      case 'admin/employees':
        return 'layout/admin-page/content/employee/index.php';
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
