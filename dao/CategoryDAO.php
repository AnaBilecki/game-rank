<?php

include_once("models/Category.php");

class CategoryDAO implements CategoryDAOInterface
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    function listAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM category");

        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
}
