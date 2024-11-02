<?php
class Start{
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $datadb = 'testdb';
    public function __construct(){
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->datadb);
        if($this->connection->connect_error){
            die("connecetion failed : " . $this->connection->connect_error);
        }
    }
    public function save($human){
        $stmt = $this->connection->prepare("INSERT INTO login (name, family) VALUES (?,?)");
        $stmt->bind_param("ss", $human->name, $human->family);
        $stmt->execute();
        $stmt->close();
    }
    public function getConnect(){
        return $this->connection;
    }
}
class human{
    public $name;
    public $family;
    public function user($name, $family){
        $this->name = $name;
        $this->family = $family;
    }
}

$connection = new Start();
$users = new human();
$users->user("mamad","rezaeii");
$connection->save($users);
echo "okay";
$connection->getConnect()->close();
?
