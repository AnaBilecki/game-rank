<?php

include_once("templates/header.php");
include_once("models/User.php");
include_once("dao/UserDAO.php");
include_once("dao/GameDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$gameDao = new GameDao($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$userGames = $gameDao->getGamesByUserId($userData->id);

?>
<div id="main-container">
    <div class="main-content">
        <h2 class="section-title">Dashboard</h2>
        <p class="section-description">Adicione novos jogos ou atualize os que você já cadastrou</p>
        <div class="add-game-container">
            <a href="<?= $BASE_URL ?>/new_game.php" class="basic-button">
                <i class="fas fa-plus"></i> Adicionar Jogo
            </a>
        </div>
        <div id="games-dashboard">
            <table class="games-table">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Nota</th>
                    <th scope="col" class="actions-column">Ações</th>
                </thead>
                <tbody>
                    <?php foreach ($userGames as $game): ?>
                        <tr>
                            <td scope="row"><?= $game->id ?></td>
                            <td><a href="<?= $BASE_URL ?>/game.php?id=<?= $game->id ?>" class="table-game-title"><?= $game->title ?></a></td>
                            <td class="rating-column"><i class="fas fa-star"></i>9</td>
                            <td class="actions-column">
                                <a href="<?= $BASE_URL ?>/edit_game.php?id=<?= $game->id ?>" class="edit-game-button">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="<?= $BASE_URL ?>/game_process.php">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $game->id ?>">
                                    <button type="submit" class="delete-game-button">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>