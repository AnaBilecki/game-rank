<?php

include_once("models/User.php");
include_once("models/Message.php");

class GameDAO implements GameDAOInterface
{
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildGame($data)
    {
        $game = new Game();

        $game->id = $data["id"];
        $game->title = $data["title"];
        $game->description = $data["description"];
        $game->image = $data["image"];
        $game->trailer = $data["trailer"];
        $game->categoryId = $data["category_id"];
        $game->userId = $data["user_id"];

        return $game;
    }

    public function findAll() {}
    public function getLatestGames() {}
    public function getGamesByCategory($category) {}
    public function getGamesByUserId($id) {}
    public function findById($id) {}
    public function findByTitle($title) {}
    public function create(Game $game) {}
    public function update(Game $game) {}
    public function destroy($id) {}
}
