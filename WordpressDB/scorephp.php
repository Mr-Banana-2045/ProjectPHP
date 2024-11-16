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
        $stmt = $this->connection->prepare("INSERT INTO wp_score (name, family, score) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $human->name, $human->family, $human->score);
        if ($stmt->execute()) {
            $stmt->close();
            return true; 
        } else {
            $stmt->close();
            return false; 
        }
    }

        public function checkUserExists($name) {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM wp_login WHERE user = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }

    public function getConnect() {
        return $this->connection;
    }
}

class Human {
    public $name;
    public $family;
    public $score;
    public function __construct($name, $family, $score) {
        $this->name = $name;
        $this->family = $family;
        $this->score = $score;
    }
}

if (isset($_GET['name']) && isset($_GET['family']) && isset($_GET['score'])) {
    $connection = new Start();
    $users = new Human($_GET['name'], $_GET['family'], (int)$_GET['score']);
    if ($connection->checkUserExists($users->family)) {
        if ($connection->save($users)) {
            header("Location: account/");
            exit();
        } else {
            echo 'Error saving data';
        }
    } else {
        echo 'User does not exist';
    }
    $connection->getConnect()->close();
}
$roles = ["ریاضی", "فارسی", "دینی", "عربی", "زبان"];
?>
