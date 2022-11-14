<?php
class Login extends Base
{
  private $conn;
  public $drop_down_data;
  public function __construct($db)
  {
    parent::__construct($db);
    $this->conn = $db;
  }

  public function register()
  {
    extract($this->escape_data($_POST));

    $result = $this->response_landing_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    // Require Fields

    $required_fields = array('username', 'email', 'password', 're_password', 'first_name', 'last_name', 'contact_no');

    foreach ($required_fields as $res) {
      if (empty(${$res})) {
        $errors[] = $res;
        $blank++;
      }
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    $check_username = $this->get_one("SELECT if(max(u.id) is null, 0, max(u.id) + 1) as `res` from tbl_user u where u.username ='$username' limit 1");
    $check_email = $this->get_one("SELECT if(max(u.id) is null, 0, max(u.id) + 1) as `res` from tbl_user u where u.email ='$email' limit 1");

    if (!empty($check_username->res)) {
      $msg .= "Username Already In-use!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', array('username'));
      return $result;
    }

    if (!empty($check_email->res)) {
      $msg .= "Username Already In-use!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', array('email'));
      return $result;
    }

    if ($password != $re_password) {
      $msg .= "Password Doest Not Match!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', array('password', 're_password'));
      return $result;
    }


    $verified = ($type == 5) ? 1 : 0;

    $this->start_transaction();
    try {
      // Insert Blotter
      $user_id = $this->insert_get_id("INSERT INTO tbl_user (username,email,`password`,branch_id,access_id,verified) VALUES('$username', '$email', '$password', '$branch', '$type', '$verified')");
      $this->query("INSERT INTO tbl_user_info (id,first_name,last_name,gender_id,contact_no) VALUES('$user_id','$first_name','$last_name','$gender','$contact_no')");

      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("User Registered Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $new = new self($this->conn);
      $new->save_error($exception->getMessage());
      $result->result = $this->response_error();
      return $result;
    }
  }

  public function login()
  {
    extract($this->escape_data($_POST));

    $result = $this->response_landing_obj();
    $blank = 0;
    $errors = array();
    $msg = '';

    // Require Fields
    $required_fields = array('username', 'password');
    foreach ($required_fields as $res) {
      if (empty(${$res})) {
        $errors[] = $res;
        $blank++;
      }
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }


    $user = $this->get_one("SELECT b.name as `branch`,ui.*,u.* from tbl_user u inner join tbl_user_info ui on ui.id = u.id inner join tbl_branch b on b.id = u.branch_id where u.username ='$username' and u.`password`='$password' and u.deleted_flag = 0 limit 1");
    $check_user = $this->get_one("SELECT if(max(u.id) is null, 0, max(u.id) + 1) as `res` from tbl_user u where u.username ='$username' and u.`password`='$password' and u.deleted_flag = 0 limit 1");

    if (empty($check_user->res)) {
      $msg .= "Invalid Username/Password!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', array('email'));
      return $result;
    }

    if (isset($user->verified) && !empty($user->verified)) {
      $_SESSION['is_logged_in'] = true;
      $_SESSION['user'] = $user;
      $result->status = true;
      $result->result = $this->response_landing_success("Please wait...", 'Logging In.,');
      return $result;
    } else {
      $msg .= "Please Contact Your Admin To Verify Your Account!";
      $result->result = $this->response_landing_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }
  }
}
