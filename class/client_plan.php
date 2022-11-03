<?php
class Client_plan extends Base
{
  private $conn;
  public function __construct($db)
  {
    parent::__construct($db);
    $this->conn = $db;
  }

  public function create()
  {
    extract($this->escape_data($_POST));

    $result = $this->response_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('plan', 'client', 'trainer', 'expiration_date');

    foreach ($required_fields as $res) {
      if (empty(${$res})) {
        $errors[] = $res;
        $blank++;
      }
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    if (!isset($workout)) {
      $msg .= "No Workout Assigned Yet!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }


    $this->start_transaction();
    try {
      $plan_id = $this->insert_get_id("INSERT INTO tbl_client_plan (`client_id`,`plan_id`,`trainer_id`,`expiration_date`) VALUES('$client', '$plan','$trainer','$expiration_date')");
      $this->query("UPDATE tbl_user set plan_expiration_date = '$expiration_date',client_plan_id ='$plan' where id = '$client'");
      foreach ($workout as $res) {
        $this->query("INSERT INTO tbl_workout_plan (client_plan_id,workout_id) VALUES ($plan,'$res')");
      }
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Client Plan Assigned Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }

  public function update()
  {
    extract($this->escape_data($_POST));

    if (isset($delete) && !empty($delete)) {
      return $this->delete($delete);
    }

    $result = $this->response_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('plan', 'client', 'trainer', 'expiration_date');

    foreach ($required_fields as $res) {
      if (empty(${$res})) {
        $errors[] = $res;
        $blank++;
      }
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    if (!isset($workout)) {
      $msg .= "No Workout Assigned Yet!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    $this->start_transaction();
    try {
      $old_client_id = $this->get_one("SELECT id from tbl_user where client_plan_id = $id")->id;
      if ($old_client_id != $client) {
        $this->query("UPDATE tbl_user set plan_expiration_date = null,client_plan_id = 0 where id = '$old_client_id'");
      }
      $this->query("UPDATE tbl_client_plan set `client_id` = '$client', `plan_id` = '$plan',`trainer_id`='$trainer',`expiration_date`='$expiration_date' where id = $id");
      $this->query("UPDATE tbl_user set plan_expiration_date = '$expiration_date',client_plan_id = $id where id = '$client'");
      $this->query("DELETE FROM tbl_workout_plan where client_plan_id = $id");
      foreach ($workout as $res) {
        $this->query("INSERT INTO tbl_workout_plan (client_plan_id,workout_id) VALUES ($id,'$res')");
      }
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Client Plan Updated Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }

  public function delete($id)
  {
    $result = $this->response_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    $this->start_transaction();
    try {
      $this->query("UPDATE tbl_client_plan set `deleted_flag` = 1 where id = $id");
      $this->query("UPDATE tbl_client_plan set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Client Plan Updated!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
