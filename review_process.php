<?php

include_once("config/globals.php");
include_once("config/db.php");
include_once("models/Game.php");
include_once("models/Message.php");
include_once("models/Review.php");
include_once("dao/UserDAO.php");
include_once("dao/GameDAO.php");
include_once("dao/ReviewDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);
$gameDao = new GameDAO($conn, $BASE_URL);
$reviewDao = new ReviewDao($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

$userData = $userDao->verifyToken();

if ($type === "create") {
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $gameId = filter_input(INPUT_POST, "game_id");
    $userId = $userData->id;

    $reviewObject = new Review();

    $game = $gameDao->findById($gameId);

    if ($game) {
        if (empty($rating)) {
            $message->setMessage("O campo nota é obrigatório.", "error", "back");
            return;
        }

        if (empty($review)) {
            $message->setMessage("O campo comentário é obrigatório.", "error", "back");
            return;
        }

        $reviewObject->rating = $rating;
        $reviewObject->review = $review;
        $reviewObject->gameId = $gameId;
        $reviewObject->userId = $userId;

        $reviewDao->create($reviewObject);
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
