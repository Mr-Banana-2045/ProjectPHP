<?php
session_start();
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
    public function authenticate($user, $password) {
        $stmt = $this->connection->prepare("SELECT password FROM wp_human WHERE name = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        if ($stmt->fetch()) {
            if (password_verify($password, $hashedPassword)) {
                return true;
            }
        }
        $stmt->close();
        return false;
    }
    public function getConnect() {
        return $this->connection;
    }
}

class Human {
    public $name;
    public function user($name) {
        $this->name = $name;
    }
}


class Passwords {
    public $password;
    public function pass($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
}

if (isset($_POST['name']) && isset($_POST['password'])) {
    $_SESSION['name'] = $_POST['name'];
    $connection = new Start();
    if ($_GET['action'] == 'login') {
        $user = $_POST['name'];
        $password = $_POST['password'];
        if ($connection->authenticate($user, $password)) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    $connection->getConnect()->close();
}
?>