<?php
session_start();
class Start {
    private $connection;
    private $host = 'sql311.infinityfree.com';
    private $user = 'if0_37718715';
    private $pass = 'c881FNW7LC4';
    private $datadb = 'if0_37718715_wp242';

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->datadb);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public function authenticate($user, $password, $role) {
        $stmt = $this->connection->prepare("SELECT password FROM wp_login WHERE user = ? AND pish = ?");
        $stmt->bind_param("ss", $user, $role);
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
    public $user;

    public function user( $user) {
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
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
}

if (isset($_GET['pish']) && isset($_GET['user']) && isset($_GET['password'])) {
    $roles = ["مدیر", "معاون", "مدیریت", "منشی", "سرایدار", "دانشجو"];
    $connection = new Start();
    if ($_GET['action'] == 'register') {
        $users = new Human();
        $posh = new Rol();
        if(in_array($_GET['pish'], $roles)){
            $passwd = new Passwords();
            $posh->shoghl($_GET['pish']);
            $users->user($_GET['user']);
            $passwd->pass($_GET['password']);
            $connection->save($users, $posh, $passwd);
        }
    } else if ($_GET['action'] == 'login') {
        $user = $_GET['user'];
        $password = $_GET['password'];
        $role = $_GET['pish'];

        if ($connection->authenticate($user, $password, $role)) {
            $_SESSION['username'] = $user;
             if (in_array($role, ["مدیر", "معاون", "مدیریت"])) {
                header("Location: http://blueuserswordpress.000.pe/wp-content/themes/twentytwentytwo/score.php");
                exit();
            } else {
                header("Location: http://blueuserswordpress.000.pe/account/");
                exit();
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; right:10px; top:30px;">Error!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        }
    }
    $connection->getConnect()->close();
}
$roles = ["مدیر", "معاون", "مدیریت", "منشی", "سرایدار", "دانشجو"];
?>