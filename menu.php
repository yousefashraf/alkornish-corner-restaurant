<?php

class Menu {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertMenuItem($image, $title, $description, $price) {
        $stmt = $this->conn->prepare("INSERT INTO menu_items (image, title, description, price) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("sssd", $image, $title, $description, $price);
        if ($stmt->execute() === false) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
    }

    public function getMenuItems() {
        $result = $this->conn->query("SELECT * FROM menu_items");
        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }
}
?>
