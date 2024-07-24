<?php
require 'env.php';

class DatabaseConnection {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct() {
        loadEnv(__DIR__ . '/.env');

        $this->servername = getenv('DB_SERVERNAME');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->dbname = getenv('DB_NAME');
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
