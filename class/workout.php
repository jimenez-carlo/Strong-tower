<?php
class Workout extends Base
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

    $required_fields = array('workout', 'reps', 'sets');

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

    $check_workout_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_workout b where b.name ='$workout' and b.sets = '$sets' and b.reps = '$reps' and deleted_flag = 0 limit 1");

    if (!empty($check_workout_name->res)) {
      $msg .= "Workout Already Exists!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('workout'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("INSERT INTO tbl_workout (`name`,`reps`,'sets', 'duration') VALUES('$workout', '$reps','$sets','$duration')");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Workout Created Successfully!", 'Successfull!');
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

    $required_fields = array('workout', 'reps', 'sets');

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

    $check_workout_name = $this->get_one("SELECT if(max(b.id) is null, 0, max(b.id) + 1) as `res` from tbl_workout b where b.name ='$workout' and b.sets = '$sets' and b.reps = '$reps' and id <> $id  and deleted_flag = 0 limit 1");

    if (!empty($check_workout_name->res)) {
      $msg .= "Workout Name Already In-use!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', array('workout'));
      return $result;
    }

    $this->start_transaction();
    try {
      $this->query("UPDATE tbl_workout set `name` = '$workout', `reps` = '$reps', `sets` = '$sets',duration = '$duration' where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Workout Updated Successfully!", 'Successfull!');
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
      $this->query("UPDATE tbl_workout set `deleted_flag` = 1 where id = $id");
      $this->commit_transaction();
      $result->status = true;
      $result->result = $this->response_success("Workout Deleted Successfully!", 'Successfull!');
      return $result;
    } catch (mysqli_sql_exception $exception) {
      $this->roll_back();
      $result->result = $this->response_error();
      return $result;
    }
  }
}
