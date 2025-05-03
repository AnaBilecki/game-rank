<?php
include_once("templates/header.php");
include_once("dao/GameDAO.php");

$user = new User();
$gameDao = new GameDAO($conn, $BASE_URL);

$id = filter_input(INPUT_GET, "id");

if (empty($id)) {
    if (!empty($userData->id)) {
        $id = $userData->id;
    } else {
        $message->setMessage("Usuário não encontrado.", "error", "index.php");
    }
} else {
    $userData = $userDao->findById($id);

    if (!$userData) {
        $message->setMessage("Usuário não encontrado.", "error", "index.php");
    }
}

$fullName = $userData->name . " " . $userData->lastname;

if ($userData->image == "") {
    $userData->image = "user.png";
}

$userGames = $gameDao->getGamesByUserId($id);

?>
<div id="main-container">
    <div class="page-profile-content">
        <h1 id="user-name"><?= $fullName ?></h1>
        <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $userData->image ?>')"></div>
        <?php if (!empty($userData->bio)): ?>
            <p class="user-bio"><?= $userData->bio ?></p>
        <?php else: ?>
            <p class="user-bio">O usuário ainda não escreveu nada aqui.</p>
        <?php endif; ?>
        <div class="horizontal-separator"></div>
        <h3 class="game-title">Jogos adicionados pelo usuário:</h3>
        <div class="games-container">
            <?php foreach ($userGames as $game): ?>
                <?php include("templates/card.php"); ?>
            <?php endforeach; ?>
            <?php if (count($userGames) === 0): ?>
                <p class="empty-list">O usuário ainda não enviou jogos.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>