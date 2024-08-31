<?php
class Users{
    private $table = "users";
    private $conn;
    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET username=:username, email=:email, pass=:pass";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));    

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":pass", $this->password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function isUserExist() {
        $query = "SELECT * FROM " . $this->table . " WHERE username = " . "'$this->username'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}