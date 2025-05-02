<?php

class Category
{

    public $id;
    public $name;
}

interface CategoryDAOInterface
{
    public function listAll();
    public function findById($id);
}
