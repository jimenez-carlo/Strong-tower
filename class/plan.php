<?php
class Plan extends Base
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

    $required_fields = array('plan_name', 'per_session', 'per_month', 'description');

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

    $check_plan_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_plan b where b.name ='$plan_name' and deleted_flag = 0 limit 1");

    if (!empty($check_plan_name->res)) {
      $msg .= "Membership Plan Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('plan_name'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("INSERT INTO tbl_plan (`name`,`description`, per_month, per_session) VALUES('$plan_name', '$description','$per_session', '$per_month')");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Membership Plan Created Successfully!", 'Successfull!');
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

    $required_fields = array('plan_name', 'per_session', 'per_month', 'description');

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

    $check_plan_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_plan b where b.name ='$plan_name' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_plan_name->res)) {
      $msg .= "Membership Plan Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('plan_name'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("UPDATE tbl_plan set `name` = '$plan_name', `description` = '$description', per_month = '$per_month',  per_session = '$per_session' where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Membership Plan Updated Successfully!", 'Successfull!');
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
      $this->query("UPDATE tbl_plan set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Membership Plan Deleted Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
