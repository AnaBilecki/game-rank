<?php
include_once("templates/header.php");
include_once("dao/GameDAO.php");

$gameDao = new GameDAO($conn, $BASE_URL);

$latestGames = $gameDao->getLatestGames();
$actionGames = $gameDao->getGamesByCategory(1);

?>
<div id="main-container">
    <div id="main-content">
        <h2 class="section-title">Jogos adicionados recentemente</h2>
        <p class="section-description">Veja as críticas dos últimos jogos adicionados</p>
        <div class="games-container">
            <?php foreach ($latestGames as $game): ?>
                <?php include("templates/card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($latestGames) === 0): ?>
                <p class="empty-list">Ainda não há jogos cadastrados.</p>
            <?php endif; ?>
        </div>
        <h2 class="section-title">Ação</h2>
        <p class="section-description">Veja os melhores jogos de Ação</p>
        <div class="games-container">
            <?php foreach ($actionGames as $game): ?>
                <?php include("templates/card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($actionGames) === 0): ?>
                <p class="empty-list">Ainda não há jogos de ação cadastrados.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>