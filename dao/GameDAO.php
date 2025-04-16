<?php

include_once("models/Game.php");
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

    public function getLatestGames()
    {
        $games = [];

        $stmt = $this->conn->query("SELECT * FROM game ORDER BY id DESC");

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $gamesArray = $stmt->fetchAll();

            foreach ($gamesArray as $game) {
                $games[] = $this->buildGame($game);
            }
        }

        return $games;
    }

    public function getGamesByCategory($category)
    {
        $games = [];

        $stmt = $this->conn->prepare("SELECT * FROM game 
            WHERE category_id = :category
            ORDER BY id DESC
        ");

        $stmt->bindParam(":category", $category);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $gamesArray = $stmt->fetchAll();

            foreach ($gamesArray as $game) {
                $games[] = $this->buildGame($game);
            }
        }

        return $games;
    }

    public function getGamesByUserId($id) {}
    public function findById($id) {}
    public function findByTitle($title) {}

    public function create(Game $game)
    {
        $stmt = $this->conn->prepare("INSERT INTO game (
                title, description, image, trailer, category_id, user_id
            ) VALUES (
                :title, :description, :image, :trailer, :categoryId, :userId 
        )");

        $stmt->bindParam(":title", $game->title);
        $stmt->bindParam(":description", $game->description);
        $stmt->bindParam(":image", $game->image);
        $stmt->bindParam(":trailer", $game->trailer);
        $stmt->bindParam(":categoryId", $game->categoryId);
        $stmt->bindParam(":userId", $game->userId);

        $stmt->execute();

        $this->message->setMessage("Jogo adicionado com sucesso!", "success", "index.php");
    }

    public function update(Game $game) {}
    public function destroy($id) {}
}
