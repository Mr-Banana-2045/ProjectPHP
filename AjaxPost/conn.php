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
$stmt = $this->connection->prepare("INSERT INTO wp_role (pish) VALUES (?)");
$stmt->bind_param("s", $human->pish);
$stmt->execute();
$stmt->close();
}

public function getConnect() {
return $this->connection;
}
}
class Human {
public $pish;
public function user($pish) {
$this->pish = $pish;
}
}
if (isset($_GET['pish'])) {
$connection = new Start();
$users = new Human();
$users->user($_GET['pish']);
$connection->save($users);
header("Location: http://localhost/end.php");
$connection->getConnect()->close();
}

?>