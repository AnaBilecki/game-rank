<?php

$fullName = $review->user->name . " " . $review->user->lastname;

if ($review->user->image == "") {
    $review->user->image = "user.png";
}
?>
<div>
    <div class="user-info">
        <div style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $review->user->image ?>')" class="user-image"></div>
        <div>
            <h4>
                <a class="user-name" href="<?= $BASE_URL ?>/profile.php?id=<?= $review->user->id ?>"><?= $fullName ?></a>
            </h4>
            <span class="rating"><i class="fas fa-star"></i> <?= $review->rating ?></span>
        </div>
    </div>
    <p class="review-label">Comentário:</p>
    <p><?= $review->review ?></p>
</div>
<div class="review-separator"></div>