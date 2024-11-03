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
    public function save($human, $rol){
        $stmt = $this->connection->prepare("INSERT INTO login (pish, name, family) VALUES (?,?,?)");
        $stmt->bind_param("sss",  $rol->pish, $human->name, $human->family);
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
class rol{
    public $pish;
    public function shoghl($pish){
        $this->pish = $pish;
    }
}
if(isset($_GET['pish']) && isset($_GET['name']) && isset($_GET['family'])){
    $connection = new Start();
    $users = new human();
    $posh = new rol();
    $posh->shoghl($_GET['pish']);
    $users->user($_GET['name'], $_GET['family']);
    $connection->save($users, $posh);
    echo "okay";
    $connection->getConnect()->close();
}
$roles = ["manager", "deputy", "Moderator", "secretary", "janitor", "student"];
?>
<form method="GET">
    <input type="text" name="pish" list="list" placeholder="pisheh ...">
    <datalist id="list">
        <?php
        foreach ($roles as $rolss){
            echo '<option value="' . $rolss . '"></option>';
        }
        ?>
        </datalist>
    <input type="text" name="name" placeholder="name ...">
    <input type="text" name="family" placeholder="family ...">
    <input type="submit" value="send">
</form>
