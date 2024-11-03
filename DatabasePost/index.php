<?php
class Start {
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $datadb = 'testdb';

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->datadb);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function save($human, $rol) {
        $stmt = $this->connection->prepare("INSERT INTO login (pish, name, family) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $rol->pish, $human->name, $human->family);
        $stmt->execute();
        $stmt->close();
    }

    public function getConnect() {
        return $this->connection;
    }
}

class Human {
    public $name;
    public $family;

    public function user($name, $family) {
        $this->name = $name;
        $this->family = $family;
    }
}

class Rol {
    public $pish;

    public function shoghl($pish) {
        $this->pish = $pish;
    }
}
if (isset($_GET['pish']) && isset($_GET['name']) && isset($_GET['family'])) {
    $roles = ["manager", "deputy", "Moderator", "secretary", "janitor", "student"];
    $connection = new Start();
    $users = new Human();
    $posh = new Rol();
    if(in_array($_GET['pish'], $roles)){
        $posh->shoghl($_GET['pish']);
        $users->user($_GET['name'], $_GET['family']);
        $connection->save($users, $posh);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="position:fixed; right:10px; top:30px;">Data has been saved successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:fixed; right:10px; top:30px;">Error!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }
    $connection->getConnect()->close();
}
$roles = ["manager", "deputy", "Moderator", "secretary", "janitor", "student"];
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
<body class="container-fluid d-flex align-items-center justify-content-center">
    <div class="card" style="width: 700px;">
  <div class="card-body">
    <h1 style="text-align:center;" class="text-primary">Login Room</h1><br>
<form method="GET">
<div class="form-group">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Job</label>
  </div>
  <select id="list" name="pish" class="custom-select" class="custom-select">
        <option selected>Choose ... </option>
    <?php foreach ($roles as $rolss) {
        echo '<option>' . $rolss . '</option>';
    }
    ?>
</select>
    </div>
    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">name</span>
  </div>
<input type="text" name="name" class="form-control" required>
</div>
<br>
<div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">family</span>
  </div>
<input type="text" name="family" class="form-control" required>
</div>
</div>
<input type="submit" value="login" class="btn btn-primary btn-lg btn-block">
</form>
</div>
</div>
</body>
</html>
