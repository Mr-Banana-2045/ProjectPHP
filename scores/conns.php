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
$stmt = $this->connection->prepare("INSERT INTO wp_score (user,name,teacher) VALUES (?,?,?)");
$stmt->bind_param("sss", $human->user,$human->name,$human->teach);
$stmt->execute();
$stmt->close();
}

public function getConnect() {
return $this->connection;
}
}
class Human {
public $user;
public $name;
public $teach;
public function user($user,$name,$teach) {
$this->user = $user;
$this->name = $name;
$this->teach = $teach;
}
}
if (isset($_GET['user']) && isset($_GET['name']) && isset($_GET['teach'])) {
$connection = new Start();
$users = new Human();
$users->user($_GET['user'],$_GET['name'],$_GET['teach']);
$connection->save($users);
header("Location: http://localhost/index/end.php");
$connection->getConnect()->close();
}

?>