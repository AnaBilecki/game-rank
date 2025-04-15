<?php
include_once("templates/header.php");
?>
<div id="main-container">
    <div id="main-content">
        <h2 class="section-title">Jogos adicionados recentemente</h2>
        <p class="section-description">Veja as críticas dos últimos jogos adicionados</p>
        <div class="games-container">
            <div class="card">
                <div class="card-image" style="background-image: url('<?= $BASE_URL ?>/img/games/game_cover.jpg')"></div>
                <div class="card-body">
                    <p class="card-rating">
                        <i class="fas fa-star"></i>
                        <span class="rating">9</span>
                    </p>
                    <h5 class="card-title">
                        <a href="#">Título do Jogo</a>
                    </h5>
                    <a href="#" class="card-button rating-button">Avaliar</a>
                    <a href="#" class="card-button details-button">Conhecer</a>
                </div>
            </div>
        </div>
        <h2 class="section-title">Ação</h2>
        <p class="section-description">Veja os melhores jogos de Ação</p>
        <div class="games-container">
        </div>
    </div>
</div>
<?php
include_once("templates/footer.php");
?>