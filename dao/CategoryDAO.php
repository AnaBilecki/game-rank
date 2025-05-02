<?php

include_once("models/Category.php");

class CategoryDAO implements CategoryDAOInterface
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function buildCategory($data)
    {
        $category = new Category();

        $category->id = $data["id"];
        $category->name = $data["name"];

        return $category;
    }

    public function listAll()
    {
        $categories = [];

        $stmt = $this->conn->query("SELECT * FROM category");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $categoriesArray = $stmt->fetchAll();

            foreach ($categoriesArray as $category) {
                $categories[] = $this->buildCategory($category);
            }
        }

        return $categories;
    }

    public function findById($id)
    {
        $category = [];

        $stmt = $this->conn->prepare("SELECT * FROM category 
            WHERE id = :id
        ");

        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $categoryData = $stmt->fetch();

            $category = $this->buildCategory($categoryData);

            return $category;
        } else {
            return false;
        }
    }
}
