
<?php
  class Database {
    private $host = "localhost";        
    private $database = "db_tk4_bran";    
    private $username = "root";    
    private $password = "";
    private $conn;
    
    public function __construct() {
      $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
      if ($this->conn->connect_error) {
        die("Koneksi database gagal: " . $this->conn->connect_error);
      }
    }
    
    public function getConnection() {
      return $this->conn;
    }
    
    public function closeConnection() {
      $this->conn->close();
    }
  }
?>
