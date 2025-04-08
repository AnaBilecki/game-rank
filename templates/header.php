<?php

include_once("config/db.php");
include_once("config/globals.php");
include_once("models/Message.php");
include_once("dao/UserDAO.php");

$message = new Message($BASE_URL);

$toast = $message->getMessage();

if (!empty($toast["message"])) {
    $message->clearMessage();
}

$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(false);

if ($userData && $userData->image == "") {
    $userData->image = "user.png";
}

$currentFile = basename($_SERVER["PHP_SELF"]);
$hidden = $currentFile == "auth.php" || $currentFile == "register.php"  ? "hidden" : "";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rank</title>
    <link rel="icon" href="<?= $BASE_URL ?>/img/joystick.png" type="image/png" />
    <link rel="stylesheet" href="<?= $BASE_URL ?>/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav id="main-navbar">
            <a href="<?= $BASE_URL ?>" id="navbar-brand">
                <img src="<?= $BASE_URL ?>/img/logo.png" alt="Game Rank" id="logo">
                <span id="gamerank-title">GAME RANK</span>
            </a>
            <form action="" method="GET" id="search-form" class="<?= $hidden ?>">
                <input type="search" name="query" id="search" placeholder="Busque um jogo...">
                <button type="submit" id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div id="navbar" class="<?= $hidden ?>">
                <ul class="navbar-container">
                    <?php if ($userData): ?>
                        <li class="nav-item">
                            <div class="user">
                                <button onclick="showMenu(event)">
                                    <div id="profile-picture" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $userData ? $userData->image : "user.png" ?>')"></div>
                                </button>
                            </div>
                            <ul id="user-menu">
                                <li>
                                    <a href="<?= $BASE_URL ?>/edit_profile.php" class="user-menu-item">
                                        <i class="fa-regular fa-user"></i>
                                        <p>Perfil</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $BASE_URL ?>/" class="user-menu-item">
                                        <i class="fa-solid fa-plus"></i>
                                        <p>Adicionar Jogo</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $BASE_URL ?>/" class="user-menu-item">
                                        <i class="fa-regular fa-star"></i>
                                        <p>Meus Jogos</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $BASE_URL ?>/logout.php" class="user-menu-item">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                        <p>Sair</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>/auth.php">Entrar</a>
                        </li>
                    <?php endif; ?>
            </div>
        </nav>
    </header>
    <?php if (!empty($toast["message"])): ?>
        <div id="toast" class="msg-container <?= $toast["type"] ?>">
            <button class="toast-button" onclick="closeToast()">
                <i class="fas fa-times"></i>
            </button>
            <div class="msg-content">
                <?php if ($toast["type"] == "error"): ?>
                    <i class="fa-solid fa-circle-exclamation fa-lg"></i>
                <?php elseif ($toast["type"] == "success"): ?>
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                <?php endif; ?>
                <p class="msg"><?= $toast["message"] ?></p>
            </div>
        </div>
    <?php endif; ?>