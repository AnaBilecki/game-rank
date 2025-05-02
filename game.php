<?php

include_once("templates/header.php");
include_once("models/Game.php");
include_once("dao/GameDAO.php");
include_once("dao/CategoryDAO.php");
include_once("dao/ReviewDAO.php");

$id = filter_input(INPUT_GET, "id");

$game;

$gameDao = new GameDao($conn, $BASE_URL);
$categoryDao = new CategoryDao($conn, $BASE_URL);
$reviewDao = new ReviewDao($conn, $BASE_URL);

$ratings = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];

if (empty($id)) {
    $message->setMessage("O jogo não foi encontrado.", "error", "index.php");
} else {
    $game = $gameDao->findById($id);
    $gameCategory = $categoryDao->findById($game->categoryId);

    if (!$game) {
        $message->setMessage("O jogo não foi encontrado.", "error", "index.php");
    }
}

if ($game->image == "") {
    $game->image = "game_cover.jpg";
}

$userOwnsGame = false;

if (!empty($userData)) {
    if ($userData->id === $game->userId) {
        $userOwnsGame = true;
    }

    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
}

$gameReviews = $reviewDao->getGamesReview($id);

?>
<div id="main-container">
    <div class="main-content">
        <h2 class="section-title"><?= $game->title ?></h2>
        <p>
            <span><?= $gameCategory->name ?></span>
            <span class="pipe"></span>
            <span class="rating"><i class="fas fa-star"></i> <?= $game->rating ?></span>
        </p>
        <div class="game-image-container">
            <div class="game-image" style="background-image: url('<?= $BASE_URL ?>/img/games/<?= $game->image ?>')"></div>
            <iframe src="<?= $game->trailer ?>"
                width="560"
                height="315"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encryted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
        <p class="game-description"><?= $game->description ?></p>
        <div>
            <div class="horizontal-separator"></div>
            <h3 class="review-title">Avaliações</h3>
            <?php if (!empty($userData) && !$userOwnsGame && !$alreadyReviewed): ?>
                <p>Envie sua avaliação</p>
                <p class="section-description">Preencha o formulário com a nota e com o comentário sobre o jogo</p>
                <form action="<?= $BASE_URL ?>/review_process.php" method="POST" class="add-review-form">
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="game_id" value="<?= $game->id ?>">
                    <div class="form-group">
                        <label for="rating">Nota do jogo: *</label>
                        <select name="rating" id="rating" class="select-option">
                            <option value="">Selecione</option>
                            <?php foreach ($ratings as $rating): ?>
                                <option value="<?= $rating ?>"><?= $rating ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review">Comentário: *</label>
                        <textarea name="review" id="review" placeholder="O que você achou do jogo?" rows="3"></textarea>
                    </div>
                    <input type="submit" class="edit-button" value="Enviar avaliação">
                </form>
            <?php endif; ?>
            <div class="review-container">
                <?php foreach ($gameReviews as $review): ?>
                    <?php include("templates/user_review.php"); ?>
                <?php endforeach; ?>
                <?php if (count($gameReviews) == 0): ?>
                    <p class="empty-list">Não há comentários para este jogo ainda.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>