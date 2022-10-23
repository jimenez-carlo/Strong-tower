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

    $required_fields = array('complaint', 'location', 'date_of_incident');

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

    if ($complainant_id == $complainee_id) {
      $errors[] = 'complainant_id';
      $errors[] = 'complainee_id';
      $msg .= "Complainant and Complainee Is the Same!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    $this->start_transaction();
    try {
      // Insert Blotter
      $blotter_id = $this->insert_get_id("INSERT INTO tbl_blotter (complainant_id, complainee_id, blotter_status_id, complaint, incidence, action_id, created_by, incidence_date) VALUES($complainant_id, $complainee_id, $status, '$complaint', '$location', '$action',1, '$date_of_incident')");

      mysqli_query($this->conn, "INSERT INTO tbl_blotter_history (blotter_id, blotter_status_id, created_by) VALUES($blotter_id, $status, 1)");

      $this->commit_transaction();
      $result->status = false;
      $result->result = $this->response_success("New Blotter Case Created!");
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
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }


    $this->start_transaction();
    try {
      // Insert Blotter
      $tmp = $this->get_one("SELECT * from tbl_user where username = '$username' and password='$password'");

      $this->commit_transaction();
      $result->extra = $tmp;
      $result->status = true;
      $result->result = $this->response_landing_success("New Blotter Case Created!");
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $new = new self($this->conn);
      $new->save_error($exception->getMessage());
      $result->result = $this->response_landing_error();
      return $result;
    }
  }
}
