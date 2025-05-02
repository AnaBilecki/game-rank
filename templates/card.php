<?php

if (empty($game->image)) {
    $game->image = "game_cover.jpg";
}

?>
<div class="card">
    <div class="card-image" style="background-image: url('<?= $BASE_URL ?>/img/games/<?= $game->image ?>')"></div>
    <div class="card-body">
        <p class="card-rating">
            <i class="fas fa-star"></i>
            <span class="rating">9</span>
        </p>
        <h5 class="card-title">
            <a href="<?= $BASE_URL ?>/game.php?id=<?= $game->id ?>"><?= $game->title ?></a>
        </h5>
        <a href="<?= $BASE_URL ?>/game.php?id=<?= $game->id ?>" class="card-button rating-button">Avaliar</a>
        <a href="<?= $BASE_URL ?>/game.php?id=<?= $game->id ?>" class="card-button details-button">Conhecer</a>
    </div>
</div>