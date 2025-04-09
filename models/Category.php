<?php

class Category
{

    public $id;
    public $name;
}

interface CategoryDAOInterface
{
    public function listAll();
}
