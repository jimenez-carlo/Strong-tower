<?php
class Equipment extends Base
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

    $required_fields = array('equipment', 'qty', 'description');

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

    $check_equipment = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_equipment b where b.name ='$equipment' and deleted_flag = 0 limit 1");

    if (!empty($check_equipment->res)) {
      $msg .= "Equipment Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('equipment'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("INSERT INTO tbl_equipment (`name`,`description`, qty) VALUES('$equipment', '$description', '$qty')");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Equipment Created Successfully!", 'Successfull!');
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

    $required_fields = array('equipment', 'qty', 'description');

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

    $check_equipment = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_equipment b where b.name ='$equipment' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_equipment->res)) {
      $msg .= "Equipment Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('equipment'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("UPDATE tbl_equipment set `name` = '$equipment', `description` = '$description', qty = '$qty' where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Equipment Updated Successfully!", 'Successfull!');
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
      $this->query("UPDATE tbl_equipment set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Equipment Deleted Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
