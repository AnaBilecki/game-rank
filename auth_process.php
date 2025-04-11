<?php

include_once("config/globals.php");
include_once("config/db.php");
include_once("models/User.php");
include_once("models/Message.php");
include_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

if (empty($email)) {
    $message->setMessage("O campo E-mail é obrigatório.", "error", "back");
    return;
}

if (empty($password)) {
    $message->setMessage("O campo Senha é obrigatório.", "error", "back");
    return;
}

if ($userDao->authenticateUser($email, $password)) {
    $message->setMessage("Seja bem-vindo(a)!", "success", "edit_profile.php");
} else {
    $message->setMessage("Usuário ou senha incorretos.", "error", "back");
}
