<?php
require('database/connection.php');
require_once('class/base.php');
require_once('class/login.php');
require_once('class/client.php');
require_once('class/trainer.php');
require_once('class/employee.php');
require_once('class/branch.php');
require_once('class/plan.php');
require_once('class/equipment.php');
require_once('class/workout.php');
require_once('class/supplement.php');
require_once('class/client_plan.php');
require_once('class/service.php');
require_once('module/common.php');

$base = new Base($conn);
$result = $base->response_error();

if (!$_POST || !isset($_POST['form'])) {
  echo json_encode($result);
  die;
}

$form = $_POST['form'];
$base = new Base($conn);
$login = new Login($conn);
$branch = new Branch($conn);
$plan = new Plan($conn);
$equipment = new Equipment($conn);
$workout = new Workout($conn);
$supplement = new Supplement($conn);
$client = new Client($conn);
$trainer = new Trainer($conn);
$employee = new Employee($conn);
$client_plan = new Client_plan($conn);
$service = new Service($conn);

switch ($form) {
    // Admin Page
  case 'create_client':
    $result = $client->create();
    break;
  case 'update_client':
    $result = $client->update();
    break;

  case 'create_trainer':
    $result = $trainer->create();
    break;
  case 'update_trainer':
    $result = $trainer->update();
    break;

  case 'create_employee':
    $result = $employee->create();
    break;
  case 'update_employee':
    $result = $employee->update();
    break;

  case 'create_branch':
    $result = $branch->create();
    break;
  case 'update_branch':
    $result = $branch->update();
    break;

  case 'create_plan':
    $result = $plan->create();
    break;
  case 'update_plan':
    $result = $plan->update();
    break;

  case 'create_equipment':
    $result = $equipment->create();
    break;
  case 'update_equipment':
    $result = $equipment->update();
    break;

  case 'create_workout':
    $result = $workout->create();
    break;
  case 'update_workout':
    $result = $workout->update();
    break;

  case 'create_supplement':
    $result = $supplement->create();
    break;
  case 'update_supplement':
    $result = $supplement->update();
    break;

  case 'create_client_plan':
    $result = $client_plan->create();
    break;
  case 'update_client_plan':
    $result = $client_plan->update();
    break;

  case 'create_service':
    $result = $service->create();
    break;
  case 'update_service':
    $result = $service->update();
    break;
    // Landing Page
  case 'landing_signup':
    $result = $base->response_landing_obj();
    $result = $login->register();
    break;
  case 'landing_login':
    $result = $base->response_landing_obj();
    $result = $login->login();
    break;
  default:
    # code...
    break;
}
echo json_encode($result);
die;
