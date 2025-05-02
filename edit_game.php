<?php

include_once("templates/header.php");
include_once("models/User.php");
include_once("dao/UserDAO.php");
include_once("dao/GameDAO.php");
include_once("dao/CategoryDAO.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$categoryDao = new CategoryDAO($conn);
$gameDao = new GameDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$categories = $categoryDao->listAll();

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {
    $message->setMessage("O jogo não foi encontrado.", "error", "index.php");
} else {
    $game = $gameDao->findById($id);

    if (!$game) {
        $message->setMessage("O jogo não foi encontrado.", "error", "index.php");
    }
}

if ($game->image == "") {
    $game->image = "game_cover.jpg";
}

?>
<div id="main-container">
    <div class="page-content">
        <div class="title-container">
            <h1 class="page-title"><?= $game->title ?></h1>
            <p class="page-description">Altere os dados do jogo no formulário abaixo:</p>
        </div>
        <form action="<?= $BASE_URL ?>/game_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $game->id ?>">
            <div class="form-group">
                <label for="title">Título: *</label>
                <input type="title" id="title" name="title" placeholder="Digite o título" value="<?= $game->title ?>">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" placeholder="Escreva uma descrição sobre o jogo" rows="5"><?= $game->description ?></textarea>
            </div>
            <div class="form-group">
                <label for="category">Categoria: *</label>
                <select name="category" id="category-select" class="select-option">
                    <option value="0" disabled selected>Selecione uma categoria</option>
                    <?php foreach ($categories as $category): ?>
                        <option
                            value="<?= $category->id ?>"
                            <?= $game->categoryId === $category->id ? "selected" : "" ?>><?= $category->name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="trailer" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $game->trailer ?>">
            </div>
            <div class="form-group file">
                <label for="image" class="file-upload-button">Adicionar imagem</label>
                <input type="file" id="image" name="image" hidden>
                <span id="file-name"></span>
            </div>
            <div class="game-image" style="background-image: url('<?= $BASE_URL ?>/img/games/<?= $game->image ?>')"></div>
            <input type="submit" value="Salvar" class="form-button">
        </form>
    </div>

</div>
<?php
include_once("templates/footer.php");
?>