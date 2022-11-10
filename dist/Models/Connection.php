<?php
class Connection
{
  public $servername = "localhost";
  public $username = "root";
  public $password = "";
  public $database = "rudolfos_test";
  public $mysqli;

  public function __construct()
  {
    $this->mysqli = new mysqli($this->servername, $this->username, $this->password, $this->database);
    if ($this->mysqli->connect_errno) {
      printf("Connect failed: %s<br />", $this->mysqli->connect_error);
      exit();
    }
    // return $this->mysqli;
  }
}
