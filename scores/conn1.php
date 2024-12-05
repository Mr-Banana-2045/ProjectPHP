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
public function save($human,$passwd) {
$stmt = $this->connection->prepare("INSERT INTO wp_human (name,pish,password,role_id) VALUES (?,?,?,?)");
$stmt->bind_param("siss", $human->name, $human->pish,$passwd->passowrd,$human->role_id);
$stmt->execute();
$stmt->close();
}
public function getConnect() {
return $this->connection;
}
}
class Human {
public $name;
public $pish;
public $role_id;
public function user($name,$pish,$role_id) {
$this->name = $name;
$this->pish = $pish;
$this->role_id = $role_id;
}
}
class passwd {
    public $passowrd;
    public function pwd($passowrd) {
    $this->passowrd = password_hash($passowrd, PASSWORD_DEFAULT);
    }
}
if (isset($_GET['name']) && isset($_GET['pish']) && isset($_GET['password'])) {
$connection = new Start();
$users = new Human();
$pass = new passwd();
$users->user($_GET['name'], $_GET['pish'],$_GET['pish']);
$pass->pwd($_GET['password']);
$connection->save($users,$pass);
header("Location: http://localhost/end.php");
$connection->getConnect()->close();
}

?>