<?php

include_once("config/globals.php");
include_once("config/db.php");
include_once("models/Game.php");
include_once("models/Message.php");
include_once("dao/UserDAO.php");
include_once("dao/GameDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);
$gameDao = new GameDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

$userData = $userDao->verifyToken();

if ($type === "create") {
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $category = filter_input(INPUT_POST, "category");
    $trailer = filter_input(INPUT_POST, "trailer");

    $game = new Game();

    if (empty($title)) {
        $message->setMessage("O campo título é obrigatório.", "error", "back");
        return;
    }

    if (empty($category)) {
        $message->setMessage("O campo categoria é obrigatório.", "error", "back");
        return;
    }

    $game->title = $title;
    $game->description = $description;
    $game->categoryId = $category;
    $game->trailer = $trailer;
    $game->userId = $userData->id;

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        if (in_array($image["type"], $imageTypes)) {
            if (in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
            } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            }

            $imageName = $game->generateImageName();

            imagejpeg($imageFile, "./img/games/" . $imageName, 100);

            $game->image = $imageName;
        } else {
            $message->setMessage("Tipo inválido de imagem, insira png ou jpeg.", "error", "back");
        }
    }

    $gameDao->create($game);
} else if ($type === "update") {
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $category = filter_input(INPUT_POST, "category");
    $trailer = filter_input(INPUT_POST, "trailer");
    $id = filter_input(INPUT_POST, "id");

    if (empty($title)) {
        $message->setMessage("O campo título é obrigatório.", "error", "back");
        return;
    }

    if (empty($category)) {
        $message->setMessage("O campo categoria é obrigatório.", "error", "back");
        return;
    }

    $game = $gameDao->findById($id);

    if ($game) {
        if ($game->userId === $userData->id) {
            $game->title = $title;
            $game->description = $description;
            $game->categoryId = $category;
            $game->trailer = $trailer;

            if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
                $image = $_FILES["image"];
                $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
                $jpgArray = ["image/jpeg", "image/jpg"];

                if (in_array($image["type"], $imageTypes)) {
                    if (in_array($image["type"], $jpgArray)) {
                        $imageFile = imagecreatefromjpeg($image["tmp_name"]);
                    } else {
                        $imageFile = imagecreatefrompng($image["tmp_name"]);
                    }

                    $imageName = $game->generateImageName();

                    imagejpeg($imageFile, "./img/games/" . $imageName, 100);

                    $game->image = $imageName;
                } else {
                    $message->setMessage("Tipo inválido de imagem, insira png ou jpeg.", "error", "back");
                }
            }

            $gameDao->update($game);
        } else {
            $message->setMessage("Informações inválidas!", "error", "index.php");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else if ($type === "delete") {
    $id = filter_input(INPUT_POST, "id");

    $game = $gameDao->findById($id);

    if ($game) {
        if ($game->userId === $userData->id) {
            $gameDao->destroy($game->id);
        } else {
            $message->setMessage("Informações inválidas!", "error", "index.php");
        }
    } else {
        $message->setMessage("Informações inválidas!", "error", "index.php");
    }
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
