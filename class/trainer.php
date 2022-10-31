<?php
class Trainer extends Base
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

    $required_fields = array('username', 'email', 'password', 're_password', 'first_name', 'middle_name', 'last_name', 'contact');

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

    if ($password != $re_password) {
      $msg .= "Password Doest Not Match!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('password', 're_password'));
      return $result;
    }

    $check_user_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_user b where b.username ='$username' and deleted_flag = 0 limit 1");

    if (!empty($check_user_name->res)) {
      $msg .= "Username Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('username'));
      return $result;
    }

    $check_email = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_user b where b.email ='$email' and deleted_flag = 0 limit 1");

    if (!empty($check_email->res)) {
      $msg .= "Email Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('email'));
      return $result;
    }

    $this->start_transaction();
    try {
      $id = $this->insert_get_id("INSERT INTO tbl_user (`username`,`email`,`password`,branch_id,access_id) VALUES('$username', '$email','$password','$branch','$access')");
      $this->query("INSERT INTO tbl_user_info (id,first_name,middle_name,last_name,gender_id,contact_no,`address`) VALUES('$id','$first_name','$middle_name','$last_name','$gender','$contact','$address')");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Trainer Created Successfully!", 'Successfull!');
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

    $required_fields = array('username', 'email', 'first_name', 'middle_name', 'last_name', 'contact');

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

    $old_password = $this->get_one("SELECT `password` from tbl_user b where id = $id limit 1")->password;
    $new_password = $old_password;
    if (!empty($password) && !empty($re_password)) {
      if ($re_password != $old_password) {
        $msg .= "Old Password Is Wrong!";
        $result->result = $this->response_error($msg);
        $result->items = implode(',', array('re_password'));
        return $result;
      }
      $new_password = $password;
    }

    $check_user_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_user b where b.name ='$username' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_user_name->res)) {
      $msg .= "Username Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('username'));
      return $result;
    }

    $check_email = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_user b where b.email ='$email' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_email->res)) {
      $msg .= "Email Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('email'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("UPDATE tbl_user set `username` = '$username', `email` = '$email', `password` = '$new_password', `branch_id` = '$branch' where id = $id");
      $this->query("UPDATE tbl_user_info set `first_name` = '$first_name', `middle_name` = '$middle_name', `middle_name` = '$middle_name', `gender_id` = '$gender', `contact_no` = '$contact', `address` = '$address' where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Trainer Updated Successfully!", 'Successfull!');
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
      $this->query("UPDATE tbl_user set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Trainer Deleted Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
