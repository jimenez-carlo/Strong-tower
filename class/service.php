<?php
class Service extends Base
{
  private $conn;
  public function __construct($db)
  {
    parent::__construct($db);
    $this->conn = $db;
  }

  public function create()
  {
    extract($this->escape_data($_POST, $_FILES, $_GET));

    $result = $this->response_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('service', 'description');

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

    $check_service_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_services b where b.name ='$service' and deleted_flag = 0 limit 1");

    if (!empty($check_service_name->res)) {
      $msg .= "Service Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('service'));
      return $result;
    }

    $this->start_transaction();
    try {
      $image_name = 'default.png';

      if ($_FILES['image']['error'] == 0) {
        $image_name = 'image_' . date('YmdHis') . '.jpeg';
        move_uploaded_file($_FILES["image"]["tmp_name"],   'assets/services/' . $image_name);
      }

      $this->query("INSERT INTO tbl_services (`name`,`description`,`image`) VALUES('$service', '$description','$image_name')");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Service Created Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }

  public function update()
  {
    extract($this->escape_data($_POST, $_FILES));

    if (isset($delete) && !empty($delete)) {
      return $this->delete($delete);
    }

    $result = $this->response_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('service', 'description');

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

    $check_service_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_services b where b.name ='$service' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_service_name->res)) {
      $msg .= "Service Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('service'));
      return $result;
    }

    $this->start_transaction();
    try {
      $image_name = $this->get_one("select image from tbl_services where id = '$id' limit 1")->image;
      if ($_FILES['image']['error'] == 0) {
        $image_name = 'image_' . date('YmdHis') . '.jpeg';
        move_uploaded_file($_FILES["image"]["tmp_name"],   'assets/services/' . $image_name);
      }

      $this->query("UPDATE tbl_services set `name` = '$service', `description` = '$description',`image`='$image_name' where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Service Updated Successfully!", 'Successfull!');
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
      $this->query("UPDATE tbl_services set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Service Deleted Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
