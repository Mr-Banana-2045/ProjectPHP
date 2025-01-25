<?php
class Start {
private $connection;
private $host = 'localhost';
private $user = 'root';
private $pass = '';
private $datadb = 'wordpress';
public function __construct() {
$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->datadb);
if ($this->connection->connect_error) {
die("Connection failed: " . $this->connection->connect_error);
}
}
public function save($human) {
$stmt = $this->connection->prepare("INSERT INTO wp_data (user,pass) VALUES (?,?)");
$stmt->bind_param("ss", $human->user,$human->pass);
$stmt->execute();
$stmt->close();
}

public function getConnect() {
return $this->connection;
}
}
class Human {
public $user;
public $pass;
public function user($user,$pass) {
$this->user = $user;
$this->pass = password_hash($pass, PASSWORD_DEFAULT);
}
}
if (isset($_GET['user']) && isset($_GET['pass'])) {
$connection = new Start();
$users = new Human();
$users->user($_GET['user'],$_GET['pass']);
$connection->save($users, $pass);
header("Location: http://localhost/");
$connection->getConnect()->close();
}
?>