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

    public function save($score, $id) {
        $stmt = $this->connection->prepare("UPDATE wp_score SET score = ? WHERE id = ?");
        $stmt->bind_param("ii", $score, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getConnect() {
        return $this->connection;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = new Start();
    foreach ($_POST['score'] as $id => $score) {
        $connection->save($score, $id);
    }
    $connection->getConnect()->close();
}
?>
