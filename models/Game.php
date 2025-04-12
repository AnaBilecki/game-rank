<?php

class Game
{

    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $categoryId;
    public $userId;

    public function generateImageName()
    {
        return bin2hex(random_bytes(60)) . ".jpg";
    }
}

interface GameDAOInterface
{

    public function buildGame($data);
    public function findAll();
    public function getLatestGames();
    public function getGamesByCategory($category);
    public function getGamesByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function create(Game $game);
    public function update(Game $game);
    public function destroy($id);
}
