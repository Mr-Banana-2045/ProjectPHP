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
    public function authenticate($user, $password) {
        $stmt = $this->connection->prepare("SELECT passowrd FROM wp_human WHERE name = ?");
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

if (isset($_GET['name']) && isset($_GET['password'])) {
    $connection = new Start();
    if ($_GET['action'] == 'register') {
        $users = new Human();
        $passwd = new Passwords();
        $users->user($_GET['name']);
        $passwd->pass($_GET['password']);
        $connection->save($users, $passwd);
    } else if ($_GET['action'] == 'login') {
        $user = $_GET['name'];
        $password = $_GET['password'];
        if ($connection->authenticate($user, $password)) {
            header("Location: http://localhost/end.php");
            exit();
        } else {
            echo 'error';
        }
    }
    $connection->getConnect()->close();
}
?>