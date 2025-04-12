<?php

include_once("templates/header.php");
include_once("models/User.php");
include_once("dao/UserDAO.php");
include_once("dao/CategoryDAO.php");

$user = new User();
$userDao = new UserDao($conn, $BASE_URL);
$categoryDao = new CategoryDAO($conn);

$userData = $userDao->verifyToken(true);

$categories = $categoryDao->listAll();

?>
<div id="main-container">
    <div class="page-content">
        <div class="title-container">
            <h1 class="page-title">Adicionar jogo</h1>
            <p class="page-description">Cadastre seu jogo favorito e confira os comentários de outros jogadores!</p>
        </div>
        <form action="<?= $BASE_URL ?>/game_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="create">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="title" id="title" name="title" placeholder="Digite o título">
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" placeholder="Escreva uma descrição sobre o jogo" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="category">Categoria:</label>
                <select name="category" id="category-select" class="select-option">
                    <option value="0" disabled selected>Selecione uma categoria</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="trailer">Trailer:</label>
                <input type="trailer" id="trailer" name="trailer" placeholder="Insira o link do trailer">
            </div>
            <div class="form-group file">
                <label for="image" class="file-upload-button">Adicionar imagem</label>
                <input type="file" id="image" name="image" hidden>
                <span id="file-name"></span>
            </div>
            <input type="submit" value="Salvar" class="form-button">
        </form>
    </div>

</div>
<?php
include_once("templates/footer.php");
?>