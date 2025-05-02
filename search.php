<?php
include_once("templates/header.php");
include_once("dao/GameDAO.php");

$gameDao = new GameDAO($conn, $BASE_URL);

$q = filter_input(INPUT_GET, "query");

$games = $gameDao->findByTitle($q);

?>
<div id="main-container">
    <div class="main-content">
        <h2 class="section-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
        <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
        <div class="games-container">
            <?php foreach ($games as $game): ?>
                <?php include("templates/card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($games) === 0): ?>
                <p class="empty-list">Não há jogos para esta busca, <a class="back-link" href="<?= $BASE_URL ?>">voltar</a>.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>