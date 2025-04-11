<?php

include_once("config/globals.php");
include_once("config/db.php");
include_once("models/User.php");
include_once("models/Message.php");
include_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if ($type === "update") {
    $userData = $userDao->verifyToken();

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    $user = new User();

    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

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

            $imageName = $user->imageGenerateName();

            imagejpeg($imageFile, "./img/users/" . $imageName, 100);

            $userData->image = $imageName;
        } else {
            $message->setMessage("Tipo inválido de imagem, insira png ou jpeg.", "error", "back");
        }
    }

    $userDao->update($userData);
} else if ($type === "change_password") {
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirm_password");

    $userData = $userDao->verifyToken();
    $id = $userData->id;

    if ($password !== $confirmPassword) {
        $message->setMessage("As senhas informadas são diferentes.", "error", "back");
        return;
    }

    if (strlen($password) < 6 || !preg_match("/[0-9]/", $password) || !preg_match("/[A-Za-z]/", $password)) {
        $message->setMessage("A senha deve ter pelo menos 6 caracteres, incluindo letras e números.", "error", "back");
        return;
    }

    $user = new User();

    $finalPassword = $user->generatePassword($password);

    $user->password = $finalPassword;
    $user->id = $id;

    $userDao->changePassword($user);
} else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
