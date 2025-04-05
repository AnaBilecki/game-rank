<?php

include_once("config/globals.php");
include_once("config/db.php");
include_once("models/User.php");
include_once("models/Message.php");
include_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

$email = $_POST["email"];
$name = $_POST["name"];
$lastname = $_POST["lastname"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

$fields = [
    "email" => "E-mail",
    "name" => "Nome",
    "lastname" => "Sobrenome",
    "password" => "Senha",
    "confirm_password" => "Confirmação de senha"
];

foreach ($fields as $field => $label) {
    if (empty($_POST[$field])) {
        $message->setMessage("O campo $label é obrigatório.", "error", "back");
        return;
    }
}

if ($password !== $confirm_password) {
    $message->setMessage("As senhas informadas são diferentes.", "error", "back");
    return;
}

if ($userDao->findByEmail($email)) {
    $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message->setMessage("E-mail inválido.", "error", "back");
    return;
}

if (strlen($password) < 6 || !preg_match("/[0-9]/", $password) || !preg_match("/[A-Za-z]/", $password)) {
    $message->setMessage("A senha deve ter pelo menos 6 caracteres, incluindo letras e números.", "error", "back");
    return;
}
