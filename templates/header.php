<?php

    include_once("config/db.php");
    include_once("config/globals.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Rank</title>
    <link rel="icon" href="<?= $BASE_URL ?>/img/joystick.png" type="image/png"/>
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
            <form action="" method="GET" id="search-form">
                <input type="search" name="query" id="search" placeholder="Busque um jogo...">
                <button type="submit" id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div id="navbar">
                <ul class="navbar-container">
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>/auth.php">Entrar</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>