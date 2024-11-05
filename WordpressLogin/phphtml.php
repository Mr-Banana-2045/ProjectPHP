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

    public function save($human, $rol, $passwords) {
        $stmt = $this->connection->prepare("INSERT INTO wp_login (pish, user, name, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $rol->pish, $human->user, $human->name, $passwords->password);
        $stmt->execute();
        $stmt->close();
    }

    public function getConnect() {
        return $this->connection;
    }
}

class Human {
    public $name;
    public $user;

    public function user($name, $user) {
        $this->name = $name;
        $this->user = $user;
    }
}

class Rol {
    public $pish;

    public function shoghl($pish) {
        $this->pish = $pish;
    }
}

class Passwords {
    public $password;

    public function pass($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}
if (isset($_GET['pish']) && isset($_GET['user']) && isset($_GET['name']) && isset($_GET['password'])) {
    $roles = ["manager", "deputy", "Moderator", "secretary", "janitor", "student"];
    $connection = new Start();
    $users = new Human();
    $posh = new Rol();
    if(in_array($_GET['pish'], $roles)){
        $passwd = new Passwords();
        $posh->shoghl($_GET['pish']);
        $users->user($_GET['name'], $_GET['user']);
        $passwd->pass(password: $_GET['password']);
        $connection->save($users, $posh, $passwd);
        header("Location: http://localhost/wordpress/wordpress/");
            exit();
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; right:10px; top:30px;">Error!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    $connection->getConnect()->close();
}
$roles = ["manager", "deputy", "Moderator", "secretary", "janitor", "student"];
?>