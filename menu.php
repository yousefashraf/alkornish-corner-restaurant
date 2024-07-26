<?php

class Menu
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertMenuItem($image, $title, $description, $price)
    {
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


    public function updateMenuItem($id, $image, $title, $description, $price)
    {
        $stmt = $this->conn->prepare("UPDATE menu_items SET image = ?, title = ?, description = ?, price = ? WHERE id = ?");
        $stmt->bind_param("sssdi", $image, $title, $description, $price, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getMenuItemById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM menu_items WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
        $stmt->close();
        return $item;
    }

    public function getMenuItems()
    {
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

    public function deleteMenuItem($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM menu_items WHERE id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        if ($stmt->execute() === false) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
    }
}
