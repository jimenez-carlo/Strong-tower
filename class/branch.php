<?php
class Branch extends Base
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

    $required_fields = array('branch_name', 'description');

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

    $check_branch_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_branch b where b.name ='$branch_name' and deleted_flag = 0 limit 1");

    if (!empty($check_branch_name->res)) {
      $msg .= "Branch Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('branch_name'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("INSERT INTO tbl_branch (`name`,`description`) VALUES('$branch_name', '$description')");
      // $this->query("INSERT INTO tbl_user_info (id,first_name,last_name,gender_id,contact_no) VALUES('$user_id','$first_name','$last_name','$gender','$contact_no')");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Branch Created Successfully!", 'Successfull!');
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

    $required_fields = array('branch_name', 'description');

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

    $check_branch_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_branch b where b.name ='$branch_name' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_branch_name->res)) {
      $msg .= "Branch Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('branch_name'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("UPDATE tbl_branch set `name` = '$branch_name', `description` = '$description' where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Branch Updated Successfully!", 'Successfull!');
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
      $this->query("UPDATE tbl_branch set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Branch Deleted Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
